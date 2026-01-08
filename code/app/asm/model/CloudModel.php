<?php

namespace app\asm\model;

use app\model\BaseModel;
use think\facade\Db;

class CloudModel extends BaseModel
{
    // 火山云资源列表
    public static function getHuoshanList($where = [], $page = 1, $limit = 20)
    {
        return Db::table('asm_cloud_huoshan')
            ->where($where)
            ->page($page, $limit)
            ->order('create_time desc')
            ->select();
    }
    
    // 火山云资源总数
    public static function getHuoshanCount($where = [])
    {
        return Db::table('asm_cloud_huoshan')->where($where)->count();
    }
    
    // 添加火山云资源
    public static function addHuoshan($data)
    {
        return Db::table('asm_cloud_huoshan')->insertGetId($data);
    }
    
    // 更新火山云资源
    public static function updateHuoshan($id, $data)
    {
        return Db::table('asm_cloud_huoshan')->where('id', $id)->update($data);
    }
    
    // 删除火山云资源
    public static function deleteHuoshan($id)
    {
        return Db::table('asm_cloud_huoshan')->where('id', $id)->delete();
    }
    
    // 天翼云资源列表
    public static function getTianyiList($where = [], $page = 1, $limit = 20)
    {
        return Db::table('asm_cloud_tianyi')
            ->where($where)
            ->page($page, $limit)
            ->order('create_time desc')
            ->select();
    }
    
    // 天翼云资源总数
    public static function getTianyiCount($where = [])
    {
        return Db::table('asm_cloud_tianyi')->where($where)->count();
    }
    
    // 添加天翼云资源
    public static function addTianyi($data)
    {
        return Db::table('asm_cloud_tianyi')->insertGetId($data);
    }
    
    // 更新天翼云资源
    public static function updateTianyi($id, $data)
    {
        return Db::table('asm_cloud_tianyi')->where('id', $id)->update($data);
    }
    
    // 删除天翼云资源
    public static function deleteTianyi($id)
    {
        return Db::table('asm_cloud_tianyi')->where('id', $id)->delete();
    }
}