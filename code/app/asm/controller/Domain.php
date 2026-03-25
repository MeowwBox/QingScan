<?php

namespace app\asm\controller;

use app\asm\model\DomainModel;
use app\controller\Common;
use think\facade\Db;
use think\facade\Session;
use think\facade\View;
use think\Request;


class Domain extends Common
{

    public function index(Request $request)
    {

        $pageSize = 20;
        $where = [];
        if ($request->param('domain')) $where[] = ['domain', '=', $request->param('domain')];
        if (!empty($request->param('app_id'))) $where[] = ['app_id', '=', $request->param('app_id')];

        $list = Db::table('asm_domain')->where($where)->order("id", 'desc')->paginate([
            'list_rows' => $pageSize,//每页数量
            'query' => $request->param(),
        ]);
        $data['list'] = $list->items();
        $data['page'] = $list->render();
        $data['flash_msg'] = Session::get('add_target_msg', '');
        return View::fetch('index', $data);
    }


    public function _add(Request $request)
    {
        $lines = explode("\n", $request->param('url'));

        DomainModel::insertTarget($lines);

        return redirect('/asm/domain/index');
    }


    public function _addTarget(Request $request)
    {
        $id = $request->param('id');
        $info = Db::table('asm_domain')->find($id);
        if (empty($info)) {
            return redirect($_SERVER['HTTP_REFERER']);
        }

        $url = "http://{$info['domain']}";
        $exists = Db::table('app')->where('url', $url)->find();
        if ($exists) {
            Session::flash('add_target_msg', '该域名已添加扫描，无需重复添加');
            return redirect($_SERVER['HTTP_REFERER']);
        }

        $data = ['url' => $url, 'name' => $info['domain'], 'status' => 1];
        Db::table('app')->insert($data);

        return redirect($_SERVER['HTTP_REFERER']);
    }


}
