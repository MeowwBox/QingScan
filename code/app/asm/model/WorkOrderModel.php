<?php

namespace app\asm\model;

use app\model\BaseModel;
use think\facade\Db;

class WorkOrderModel extends BaseModel
{
    // 获取工单列表
    public static function getWorkOrders($where = [], $page = 1, $limit = 20)
    {
        return Db::table('asm_work_order')
            ->where($where)
            ->order('updated_at desc')
            ->page($page, $limit)
            ->select();
    }
    
    // 获取工单总数
    public static function getWorkOrdersCount($where = [])
    {
        return Db::table('asm_work_order')->where($where)->count();
    }
    
    // 根据ID获取工单
    public static function getWorkOrderById($id)
    {
        return Db::table('asm_work_order')->where('id', $id)->find();
    }
    
    // 添加工单
    public static function addWorkOrder($data)
    {
        return Db::table('asm_work_order')->insertGetId($data);
    }
    
    // 更新工单
    public static function updateWorkOrder($id, $data)
    {
        return Db::table('asm_work_order')->where('id', $id)->update($data);
    }
    
    // 删除工单
    public static function deleteWorkOrder($id)
    {
        return Db::table('asm_work_order')->where('id', $id)->delete();
    }
    
    // 根据漏洞ID获取关联工单
    public static function getWorkOrdersByVulId($vul_id, $vul_type)
    {
        return Db::table('asm_work_order')
            ->where('vul_id', $vul_id)
            ->where('vul_type', $vul_type)
            ->order('updated_at desc')
            ->select();
    }
}