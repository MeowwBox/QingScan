<?php

namespace app\asm\controller;

use app\BaseController;
use app\asm\model\CloudModel;
use think\facade\View;
use think\facade\Db;
use think\facade\Request;

class Cloud extends BaseController
{
    // 火山云列表页
    public function huoshan()
    {
        $pageSize = 20;
        $where = [];
        
        $list = Db::table('asm_cloud_huoshan')
            ->where($where)
            ->order('create_time desc')
            ->paginate([
                'list_rows' => $pageSize,
                'query' => Request::param(),
            ]);
        
        View::assign('list', $list->items());
        View::assign('page', $list);
        
        return View::fetch('cloud/huoshan');
    }
    
    // 天翼云列表页
    public function tianyi()
    {
        $pageSize = 20;
        $where = [];
        
        $list = Db::table('asm_cloud_tianyi')
            ->where($where)
            ->order('create_time desc')
            ->paginate([
                'list_rows' => $pageSize,
                'query' => Request::param(),
            ]);
        
        View::assign('list', $list->items());
        View::assign('page', $list);
        
        return View::fetch('cloud/tianyi');
    }
    
    // 移动云列表页
    public function yidong()
    {
        $pageSize = 20;
        $where = [];
        
        $list = Db::table('asm_cloud_yidong')
            ->where($where)
            ->order('create_time desc')
            ->paginate([
                'list_rows' => $pageSize,
                'query' => Request::param(),
            ]);
        
        View::assign('list', $list->items());
        View::assign('page', $list);
        
        return View::fetch('cloud/yidong');
    }
 }