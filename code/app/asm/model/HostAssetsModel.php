<?php

namespace app\asm\model;

use app\model\BaseModel;
use think\facade\Db;
use app\asm\model\CloudModel;

class HostAssetsModel extends BaseModel
{
    // 主机资产列表
    public static function getHostAssetsList($where = [], $page = 1, $limit = 20)
    {
        return Db::table('asm_host_assets')
            ->where($where)
            ->page($page, $limit)
            ->order('create_time desc')
            ->select();
    }
    
    // 主机资产总数
    public static function getHostAssetsCount($where = [])
    {
        return Db::table('asm_host_assets')->where($where)->count();
    }
    
    // 添加主机资产
    public static function addHostAssets($data)
    {
        return Db::table('asm_host_assets')->insertGetId($data);
    }
    
    // 批量添加主机资产
    public static function batchAddHostAssets($data)
    {
        return Db::table('asm_host_assets')->insertAll($data);
    }
    
    // 更新主机资产
    public static function updateHostAssets($id, $data)
    {
        return Db::table('asm_host_assets')->where('id', $id)->update($data);
    }
    
    // 根据实例ID和平台更新主机资产
    public static function updateByInstanceIdAndPlatform($instanceId, $platform, $data)
    {
        return Db::table('asm_host_assets')
            ->where('instance_id', $instanceId)
            ->where('cloud_platform', $platform)
            ->update($data);
    }
    
    // 删除主机资产
    public static function deleteHostAssets($id)
    {
        return Db::table('asm_host_assets')->where('id', $id)->delete();
    }
    
    // 获取单个主机资产
    public static function getHostAssetsById($id)
    {
        return Db::table('asm_host_assets')->where('id', $id)->find();
    }
    
    // 根据实例ID和平台获取主机资产
    public static function getByInstanceIdAndPlatform($instanceId, $platform)
    {
        return Db::table('asm_host_assets')
            ->where('instance_id', $instanceId)
            ->where('cloud_platform', $platform)
            ->find();
    }
    
    // 批量更新所有主机资产
    public static function updateAll($data)
    {
        return Db::table('asm_host_assets')->where('id', '>', 0)->update($data);
    }
    
    // 更新HIDS状态
    public static function updateHidsStatus($id, $installed, $version = '', $lastCheck = null)
    {
        $data = [
            'hids_installed' => $installed,
        ];
        
        if ($version) {
            $data['hids_version'] = $version;
        }
        
        if ($lastCheck) {
            $data['hids_last_check'] = $lastCheck;
        }
        
        return Db::table('asm_host_assets')->where('id', $id)->update($data);
    }
    
    // 从火山云API数据导入主机资产
    public static function importFromHuoshanApi($apiData)
    {
        if (empty($apiData['Result']['Instances'])) {
            return false;
        }
        
        $hosts = [];
        $huoshanResources = [];
        foreach ($apiData['Result']['Instances'] as $instance) {
            // 获取私有IP
            $privateIp = '0.0.0.0'; // 默认值
            if (!empty($instance['networkInterfaces']) && is_array($instance['networkInterfaces']) && count($instance['networkInterfaces']) > 0) {
                $firstInterface = $instance['networkInterfaces'][0];
                if (isset($firstInterface['primaryIpAddress'])) {
                    $privateIp = $firstInterface['primaryIpAddress'];
                }
            }
            
            // 获取公网IP
            $publicIp = '';
            if (!empty($instance['eipAddress']) && is_object($instance['eipAddress']) && isset($instance['eipAddress']->ipAddress)) {
                $publicIp = $instance['eipAddress']->ipAddress;
            } else if (!empty($instance['eipAddress']) && is_array($instance['eipAddress']) && isset($instance['eipAddress']['ipAddress'])) {
                $publicIp = $instance['eipAddress']['ipAddress'];
            }
            
            // 获取MAC地址
            $macAddress = '';
            if (!empty($instance['networkInterfaces']) && is_array($instance['networkInterfaces']) && count($instance['networkInterfaces']) > 0) {
                $firstInterface = $instance['networkInterfaces'][0];
                if (isset($firstInterface['macAddress'])) {
                    $macAddress = $firstInterface['macAddress'];
                }
            }
            
            // 获取安全组
            $securityGroups = [];
            if (!empty($instance['networkInterfaces']) && is_array($instance['networkInterfaces']) && count($instance['networkInterfaces']) > 0) {
                $firstInterface = $instance['networkInterfaces'][0];
                if (isset($firstInterface['securityGroupIds']) && is_array($firstInterface['securityGroupIds'])) {
                    $securityGroups = $firstInterface['securityGroupIds'];
                }
            }
            
            // 构建主机资产数据
            $hosts[] = [
                'instance_id' => $instance['instanceId'],
                'instance_name' => $instance['instanceName'],
                'display_name' => $instance['instanceName'],
                'cloud_platform' => 'huoshan',
                'status' => strtoupper($instance['status']),
                'private_ip' => $privateIp,
                'public_ip' => $publicIp,
                'mac_address' => $macAddress,
                'os_type' => $instance['osType'],
                'os_name' => $instance['osName'],
                'cpu' => $instance['cpus'],
                'memory' => $instance['memorySize'],
                'instance_type' => $instance['instanceTypeId'],
                'vpc_id' => $instance['vpcId'],
                'vpc_name' => '',
                'security_groups' => json_encode($securityGroups),
                'create_time' => !empty($instance['createdAt']) ? date('Y-m-d H:i:s', strtotime($instance['createdAt'])) : null,
                'update_time' => !empty($instance['updatedAt']) ? date('Y-m-d H:i:s', strtotime($instance['updatedAt'])) : null,
                'expire_time' => !empty($instance['expiredAt']) ? date('Y-m-d H:i:s', strtotime($instance['expiredAt'])) : null,
                'hids_installed' => 0,
            ];
            
            // 构建火山云资源表数据
            $huoshanResources[] = [
                'resource_id' => $instance['instanceId'],
                'resource_name' => $instance['instanceName'],
                'resource_type' => 'instance',
                'region' => $instance['region'] ?? '',
                'status' => strtoupper($instance['status']),
                'public_ip' => $publicIp,
                'private_ip' => $privateIp,
                'os_type' => $instance['osType'],
                'os_name' => $instance['osName'],
                'cpu' => $instance['cpus'],
                'memory' => $instance['memorySize'],
                'instance_type' => $instance['instanceTypeId'],
                'vpc_id' => $instance['vpcId'],
                'create_time' => !empty($instance['createdAt']) ? date('Y-m-d H:i:s', strtotime($instance['createdAt'])) : null,
                'update_time' => !empty($instance['updatedAt']) ? date('Y-m-d H:i:s', strtotime($instance['updatedAt'])) : null,
                'expire_time' => !empty($instance['expiredAt']) ? date('Y-m-d H:i:s', strtotime($instance['expiredAt'])) : null,
            ];
        }
        
        // 批量导入或更新
        foreach ($hosts as $index => $host) {
            // 处理主机资产表
            $existing = self::getByInstanceIdAndPlatform($host['instance_id'], $host['cloud_platform']);
            if ($existing) {
                // 更新现有记录
                unset($host['create_time']); // 不更新创建时间
                self::updateByInstanceIdAndPlatform($host['instance_id'], $host['cloud_platform'], $host);
            } else {
                // 添加新记录
                self::addHostAssets($host);
            }
            
            // 处理火山云资源表
            $huoshanResource = $huoshanResources[$index];
            $existingHuoshan = Db::table('asm_cloud_huoshan')->where('resource_id', $huoshanResource['resource_id'])->find();
            if ($existingHuoshan) {
                // 更新现有记录
                unset($huoshanResource['create_time']); // 不更新创建时间
                Db::table('asm_cloud_huoshan')->where('id', $existingHuoshan['id'])->update($huoshanResource);
            } else {
                // 添加新记录
                CloudModel::addHuoshan($huoshanResource);
            }
        }
        
        return true;
    }
    
    // 从天翼云API数据导入主机资产
    public static function importFromTianyiApi($apiData)
    {
        if (empty($apiData['returnObj']['results'])) {
            return false;
        }
        
        $hosts = [];
        foreach ($apiData['returnObj']['results'] as $instance) {
            // 获取私有IP
            $privateIp = $instance['privateIP'];
            
            // 获取公网IP
            $publicIp = $instance['floatingIP'] ?: '';
            
            // 获取MAC地址
            $macAddress = '';
            if (!empty($instance['addresses'][0]['addressList'])) {
                foreach ($instance['addresses'][0]['addressList'] as $address) {
                    if ($address['isMaster'] && $address['type'] == 'fixed') {
                        $macAddress = $address['macAddress'];
                        break;
                    }
                }
            }
            
            // 获取安全组
            $securityGroups = [];
            if (!empty($instance['secGroupList'])) {
                foreach ($instance['secGroupList'] as $sg) {
                    $securityGroups[] = [
                        'id' => $sg['securityGroupID'],
                        'name' => $sg['securityGroupName'],
                    ];
                }
            }
            
            $hosts[] = [
                'instance_id' => $instance['instanceID'],
                'instance_name' => $instance['instanceName'],
                'display_name' => $instance['displayName'],
                'cloud_platform' => 'tianyi',
                'status' => $instance['instanceStatus'],
                'private_ip' => $privateIp,
                'public_ip' => $publicIp,
                'mac_address' => $macAddress,
                'os_type' => $instance['osType'] == 1 ? 'Linux' : ($instance['osType'] == 2 ? 'Windows' : 'Other'),
                'os_name' => $instance['image']['imageName'],
                'cpu' => $instance['flavor']['flavorCPU'],
                'memory' => $instance['flavor']['flavorRAM'],
                'instance_type' => $instance['flavor']['flavorName'],
                'vpc_id' => $instance['vpcID'],
                'vpc_name' => $instance['vpcName'],
                'security_groups' => json_encode($securityGroups),
                'create_time' => date('Y-m-d H:i:s', strtotime($instance['createdTime'])),
                'update_time' => date('Y-m-d H:i:s', strtotime($instance['updatedTime'])),
                'expire_time' => !empty($instance['expiredTime']) ? date('Y-m-d H:i:s', strtotime($instance['expiredTime'])) : null,
                'hids_installed' => 0,
            ];
        }
        
        // 批量导入或更新
        foreach ($hosts as $host) {
            $existing = self::getByInstanceIdAndPlatform($host['instance_id'], $host['cloud_platform']);
            if ($existing) {
                // 更新现有记录
                unset($host['create_time']); // 不更新创建时间
                self::updateByInstanceIdAndPlatform($host['instance_id'], $host['cloud_platform'], $host);
            } else {
                // 添加新记录
                self::addHostAssets($host);
            }
        }
        
        return true;
    }
}