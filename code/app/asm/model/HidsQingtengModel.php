<?php

namespace app\asm\model;

use think\facade\Db;
use app\model\BaseModel;

class HidsQingtengModel extends BaseModel
{
    // 表名
    protected static $tableName = 'asm_hids_qingteng';
    
    /**
     * 获取青藤云HIDS列表
     * @param array $where 查询条件
     * @param int $page 页码
     * @param int $limit 每页数量
     * @return array
     */
    public static function getList($where = [], $page = 1, $limit = 20)
    {
        return Db::table(self::$tableName)
            ->where($where)
            ->page($page, $limit)
            ->order('created_time desc')
            ->select()
            ->toArray();
    }
    
    /**
     * 获取青藤云HIDS总数
     * @param array $where 查询条件
     * @return int
     */
    public static function getCount($where = [])
    {
        return Db::table(self::$tableName)->where($where)->count();
    }
    
    /**
     * 添加青藤云HIDS记录
     * @param array $data 数据
     * @return int|string
     */
    public static function add($data)
    {
        try {
            return Db::table(self::$tableName)->insertGetId($data);
        } catch (\Exception $e) {
            // 记录错误信息
            file_put_contents('/tmp/hids_qingteng_error.log', 
                date('Y-m-d H:i:s') . " - Error: " . $e->getMessage() . "\n" .
                "Data: " . print_r($data, true) . "\n\n",
                FILE_APPEND
            );
            // 重新抛出异常
            throw $e;
        }
    }
    
    /**
     * 批量添加青藤云HIDS记录
     * @param array $data 数据
     * @return int
     */
    public static function batchAdd($data)
    {
        return Db::table(self::$tableName)->insertAll($data);
    }
    
    /**
     * 更新青藤云HIDS记录
     * @param int $id ID
     * @param array $data 数据
     * @return int
     */
    public static function update($id, $data)
    {
        return Db::table(self::$tableName)->where('id', $id)->update($data);
    }
    
    /**
     * 根据实例ID更新青藤云HIDS记录
     * @param string $instanceId 实例ID
     * @param array $data 数据
     * @return int
     */
    public static function updateByInstanceId($instanceId, $data)
    {
        return Db::table(self::$tableName)->where('instance_id', $instanceId)->update($data);
    }
    
    /**
     * 根据IP地址更新青藤云HIDS记录
     * @param string $ipAddress IP地址
     * @param array $data 数据
     * @return int
     */
    public static function updateByIpAddress($ipAddress, $data)
    {
        return Db::table(self::$tableName)->where('ip_address', $ipAddress)->update($data);
    }
    
    /**
     * 删除青藤云HIDS记录
     * @param int $id ID
     * @return int
     */
    public static function delete($id)
    {
        return Db::table(self::$tableName)->where('id', $id)->delete();
    }
    
    /**
     * 获取单个青藤云HIDS记录
     * @param int $id ID
     * @return array
     */
    public static function getById($id)
    {
        return Db::table(self::$tableName)->where('id', $id)->find();
    }
    
    /**
     * 根据实例ID获取青藤云HIDS记录
     * @param string $instanceId 实例ID
     * @return array
     */
    public static function getByInstanceId($instanceId)
    {
        return Db::table(self::$tableName)->where('instance_id', $instanceId)->find();
    }
    
    /**
     * 根据IP地址获取青藤云HIDS记录
     * @param string $ipAddress IP地址
     * @return array
     */
    public static function getByIpAddress($ipAddress)
    {
        return Db::table(self::$tableName)->where('ip_address', $ipAddress)->find();
    }
    
    /**
     * 保存原始JSON数据
     * @param array $jsonData 原始JSON数据
     * @return int|string
     */
    public static function saveOriginalJson($jsonData)
    {
        // 从JSON数据中提取关键信息
        $instanceId = $jsonData['instance_id'] ?? $jsonData['id'] ?? null;
        $hostname = $jsonData['hostname'] ?? $jsonData['name'] ?? null;
        $ipAddress = $jsonData['ip_address'] ?? $jsonData['ip'] ?? null;
        $osType = $jsonData['os_type'] ?? $jsonData['os'] ?? null;
        $osVersion = $jsonData['os_version'] ?? $jsonData['version'] ?? null;
        $agentStatus = $jsonData['agent_status'] ?? $jsonData['status'] ?? null;
        $agentVersion = $jsonData['agent_version'] ?? $jsonData['version'] ?? null;
        $lastHeartbeat = $jsonData['last_heartbeat'] ?? $jsonData['update_time'] ?? null;
        
        // 构建数据
        $data = [
            'instance_id' => $instanceId,
            'hostname' => $hostname,
            'ip_address' => $ipAddress,
            'os_type' => $osType,
            'os_version' => $osVersion,
            'agent_status' => $agentStatus,
            'agent_version' => $agentVersion,
            'last_heartbeat' => $lastHeartbeat ? date('Y-m-d H:i:s', strtotime($lastHeartbeat)) : null,
            'original_json' => json_encode($jsonData),
            'updated_time' => date('Y-m-d H:i:s'),
        ];
        
        // 检查是否已存在记录
        $existing = null;
        if ($instanceId) {
            $existing = self::getByInstanceId($instanceId);
        } elseif ($ipAddress) {
            $existing = self::getByIpAddress($ipAddress);
        }
        
        if ($existing) {
            // 更新现有记录
            return self::update($existing['id'], $data);
        } else {
            // 添加新记录
            $data['created_time'] = date('Y-m-d H:i:s');
            return self::add($data);
        }
    }
}