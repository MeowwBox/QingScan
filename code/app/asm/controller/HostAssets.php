<?php

namespace app\asm\controller;

use app\asm\model\HostAssetsModel;
use app\base\BaseController;
use app\controller\Common;
use think\facade\View;
use think\facade\Db;
use think\facade\Request;

class HostAssets extends Common
{
    // 主机资产列表
    public function index()
    {
        // 获取搜索条件
        $keyword = Request::param('keyword', '');
        $cloud_platform = Request::param('cloud_platform', '');
        $status = Request::param('status', '');
        $hids_installed = Request::param('hids_installed', '');
        
        // 构建查询条件
        $where = [];
        if (!empty($keyword)) {
            $where[] = ['instance_name|display_name|private_ip|public_ip', 'like', '%' . $keyword . '%'];
        }
        if (!empty($cloud_platform)) {
            $where['cloud_platform'] = $cloud_platform;
        }
        if (!empty($status)) {
            $where['status'] = $status;
        }
        if ($hids_installed !== '') {
            $where['hids_installed'] = intval($hids_installed);
        }
        
        // 获取分页参数
        $page = Request::param('page', 1, 'intval');
        $limit = Request::param('limit', 20, 'intval');
        
        // 获取数据
        $list = Db::table('asm_host_assets')
            ->where($where)
            ->order('create_time desc')
            ->paginate([
                'list_rows' => $limit,
                'page' => $page,
                'query' => Request::param()
            ]);
        
        // 平台类型
        $platforms = [
            '' => '全部',
            'huoshan' => '火山云',
            'tianyi' => '天翼云',
            'idc' => '线下IDC'
        ];
        
        // HIDS安装状态
        $hids_status = [
            '' => '全部',
            '0' => '未安装',
            '1' => '已安装'
        ];
        
        // 实例状态
        $instance_status = [
            '' => '全部',
            'RUNNING' => '运行中',
            'STOPPED' => '已停止',
            'TERMINATED' => '已终止',
            'CREATING' => '创建中',
            'STARTING' => '启动中',
            'STOPPING' => '停止中',
            'REBOOTING' => '重启中',
            'SHUTOFF' => '已关闭'
        ];
        
        View::assign([
            'list' => $list,
            'platforms' => $platforms,
            'hids_status' => $hids_status,
            'instance_status' => $instance_status,
            'keyword' => $keyword,
            'cloud_platform' => $cloud_platform,
            'status' => $status,
            'hids_installed' => $hids_installed
        ]);
        
        return View::fetch();
    }
    
    // 更新HIDS状态
    public function updateHidsStatus()
    {
        $id = Request::param('id', '', 'intval');
        $hids_installed = Request::param('hids_installed', '', 'intval');
        $hids_version = Request::param('hids_version', '', 'trim');
        
        if (empty($id)) {
            return json(['code' => 0, 'msg' => '参数错误']);
        }
        
        $data = [
            'hids_installed' => $hids_installed,
            'hids_version' => $hids_version,
            'hids_last_check' => date('Y-m-d H:i:s')
        ];
        
        $result = HostAssetsModel::updateHostAssets($id, $data);
        
        if ($result) {
            return json(['code' => 1, 'msg' => '更新成功']);
        } else {
            return json(['code' => 0, 'msg' => '更新失败']);
        }
    }
    
    // 导入主机资产
    public function import()
    {
        return View::fetch();
    }
    
    // 执行导入
    public function doImport()
    {
        // 这里可以实现从CSV或其他格式导入线下IDC数据的功能
        return json(['code' => 1, 'msg' => '导入功能开发中']);
    }
    
    // 同步云资产
    public function syncCloudAssets()
    {
        // 这里可以实现从云平台API同步最新数据的功能
        return json(['code' => 1, 'msg' => '同步功能开发中']);
    }
    
    // 查看主机资产详情
    public function detail()
    {
        $id = Request::param('id', '', 'intval');
        
        if (empty($id)) {
            $this->error('参数错误');
        }
        
        $host = HostAssetsModel::getHostAssetsById($id);
        
        if (empty($host)) {
            $this->error('主机资产不存在');
        }
        
        // 解析安全组数据
        if (!empty($host['security_groups'])) {
            $host['security_groups'] = json_decode($host['security_groups'], true);
        } else {
            $host['security_groups'] = [];
        }
        
        View::assign([
            'host' => $host
        ]);
        
        return View::fetch();
    }
    
    // 添加线下IDC主机
    public function addIdcHost()
    {
        return View::fetch();
    }
    
    // 保存线下IDC主机
    public function saveIdcHost()
    {
        $data = Request::post();
        
        // 验证数据
        if (empty($data['instance_name']) || empty($data['private_ip'])) {
            return json(['code' => 0, 'msg' => '实例名称和私有IP不能为空']);
        }
        
        // 构建数据
        $host_data = [
            'instance_id' => 'idc_' . uniqid(),
            'instance_name' => $data['instance_name'],
            'display_name' => $data['display_name'] ?: $data['instance_name'],
            'cloud_platform' => 'idc',
            'status' => 'running',
            'private_ip' => $data['private_ip'],
            'public_ip' => $data['public_ip'],
            'mac_address' => $data['mac_address'],
            'os_type' => $data['os_type'],
            'os_name' => $data['os_name'],
            'cpu' => $data['cpu'],
            'memory' => $data['memory'],
            'instance_type' => $data['instance_type'],
            'vpc_id' => $data['vpc_id'],
            'vpc_name' => $data['vpc_name'],
            'security_groups' => json_encode([]),
            'create_time' => date('Y-m-d H:i:s'),
            'update_time' => date('Y-m-d H:i:s'),
            'hids_installed' => 0
        ];
        
        // 保存数据
        $result = HostAssetsModel::addHostAssets($host_data);
        
        if ($result) {
            return json(['code' => 1, 'msg' => '添加成功', 'url' => url('/asm/hostassets/index')]);
        } else {
            return json(['code' => 0, 'msg' => '添加失败']);
        }
    }
    
    // 编辑主机资产
    public function edit()
    {
        $id = Request::param('id', '', 'intval');
        
        if (empty($id)) {
            $this->error('参数错误');
        }
        
        $host = HostAssetsModel::getHostAssetsById($id);
        
        if (empty($host)) {
            $this->error('主机资产不存在');
        }
        
        View::assign([
            'host' => $host
        ]);
        
        return View::fetch();
    }
    
    // 更新主机资产
    public function update()
    {
        $id = Request::param('id', '', 'intval');
        $data = Request::post();
        
        if (empty($id)) {
            return json(['code' => 0, 'msg' => '参数错误']);
        }
        
        // 更新数据
        $update_data = [
            'display_name' => $data['display_name'],
            'public_ip' => $data['public_ip'],
            'mac_address' => $data['mac_address'],
            'os_type' => $data['os_type'],
            'os_name' => $data['os_name'],
            'cpu' => $data['cpu'],
            'memory' => $data['memory'],
            'instance_type' => $data['instance_type'],
            'vpc_id' => $data['vpc_id'],
            'vpc_name' => $data['vpc_name'],
            'update_time' => date('Y-m-d H:i:s')
        ];
        
        $result = HostAssetsModel::updateHostAssets($id, $update_data);
        
        if ($result) {
            return json(['code' => 1, 'msg' => '更新成功', 'url' => url('/asm/hostassets/index')]);
        } else {
            return json(['code' => 0, 'msg' => '更新失败']);
        }
    }
    
    // 删除主机资产
    public function delete()
    {
        $id = Request::param('id', '', 'intval');
        
        if (empty($id)) {
            return json(['code' => 0, 'msg' => '参数错误']);
        }
        
        // 检查是否为线下IDC主机
        $host = HostAssetsModel::getHostAssetsById($id);
        if (empty($host)) {
            return json(['code' => 0, 'msg' => '主机资产不存在']);
        }
        
        // 只有线下IDC主机可以删除
        if ($host['cloud_platform'] != 'idc') {
            return json(['code' => 0, 'msg' => '仅可删除线下IDC主机']);
        }
        
        $result = HostAssetsModel::deleteHostAssets($id);
        
        if ($result) {
            return json(['code' => 1, 'msg' => '删除成功']);
        } else {
            return json(['code' => 0, 'msg' => '删除失败']);
        }
    }
}