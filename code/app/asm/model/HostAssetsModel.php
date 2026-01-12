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
        try {
            return Db::table('asm_host_assets')->insertGetId($data);
        } catch (\Exception $e) {
            // 记录错误信息
            file_put_contents('/tmp/host_assets_error.log', 
                date('Y-m-d H:i:s') . " - Error: " . $e->getMessage() . "\n" .
                "Data: " . print_r($data, true) . "\n\n",
                FILE_APPEND
            );
            // 重新抛出异常
            throw $e;
        }
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
            // 获取所有私有IP
            $privateIps = [];
            if (!empty($instance['networkInterfaces']) && is_array($instance['networkInterfaces'])) {
                foreach ($instance['networkInterfaces'] as $interface) {
                    if (isset($interface['primaryIpAddress'])) {
                        $privateIps[] = $interface['primaryIpAddress'];
                    }
                    if (isset($interface['privateIpSets']) && is_array($interface['privateIpSets'])) {
                        foreach ($interface['privateIpSets'] as $ipSet) {
                            if (isset($ipSet['privateIpAddress'])) {
                                $privateIps[] = $ipSet['privateIpAddress'];
                            }
                        }
                    }
                }
            }
            // 去重并保留唯一IP
            $privateIps = array_unique($privateIps);
            // 设置默认私有IP
            $privateIp = !empty($privateIps) ? reset($privateIps) : '0.0.0.0';
            
            // 获取所有公网IP
            $publicIps = [];
            if (!empty($instance['eipAddress'])) {
                if (is_object($instance['eipAddress']) && isset($instance['eipAddress']->ipAddress)) {
                    $publicIps[] = $instance['eipAddress']->ipAddress;
                } else if (is_array($instance['eipAddress']) && isset($instance['eipAddress']['ipAddress'])) {
                    $publicIps[] = $instance['eipAddress']['ipAddress'];
                }
            }
            // 如果networkInterfaces中有公网IP，也添加到列表中
            if (!empty($instance['networkInterfaces']) && is_array($instance['networkInterfaces'])) {
                foreach ($instance['networkInterfaces'] as $interface) {
                    if (isset($interface['publicIpAddress'])) {
                        $publicIps[] = $interface['publicIpAddress'];
                    }
                    if (isset($interface['publicIpSets']) && is_array($interface['publicIpSets'])) {
                        foreach ($interface['publicIpSets'] as $ipSet) {
                            if (isset($ipSet['publicIpAddress'])) {
                                $publicIps[] = $ipSet['publicIpAddress'];
                            }
                        }
                    }
                }
            }
            // 去重并保留唯一IP
            $publicIps = array_unique($publicIps);
            // 设置默认公网IP
            $publicIp = !empty($publicIps) ? reset($publicIps) : '';
            
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
                'private_ips' => json_encode($privateIps),
                'public_ips' => json_encode($publicIps),
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
                'public_ips' => json_encode($publicIps),
                'private_ips' => json_encode($privateIps),
                'os_type' => $instance['osType'],
                'os_name' => $instance['osName'],
                'cpu' => $instance['cpus'],
                'memory' => $instance['memorySize'],
                'instance_type' => $instance['instanceTypeId'],
                'vpc_id' => $instance['vpcId'],
                'create_time' => !empty($instance['createdAt']) ? date('Y-m-d H:i:s', strtotime($instance['createdAt'])) : null,
                'update_time' => !empty($instance['updatedAt']) ? date('Y-m-d H:i:s', strtotime($instance['updatedAt'])) : null,
                'expire_time' => !empty($instance['expiredAt']) ? date('Y-m-d H:i:s', strtotime($instance['expiredAt'])) : null,
                'original_json' => json_encode($instance, JSON_UNESCAPED_UNICODE),
            ];
        }
        
        // 批量导入或更新
        foreach ($hosts as $index => $host) {
            // 处理主机资产表
            $existing = self::getByInstanceIdAndPlatform($host['instance_id'], $host['cloud_platform']);
            
            // 移除原始数据字段，因为不需要保存到数据库中
            unset($host['original_data']);
            
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
    
    // 从阿里云API数据导入主机资产
    public static function importFromAliyunApi($apiData)
    {
        if (empty($apiData['Instances'])) {
            return false;
        }
        
        $hosts = [];
        foreach ($apiData['Instances'] as $index => $instance) {
            // 安全地获取实例ID，同时处理对象和数组类型，尝试多个可能的字段名
            if (is_object($instance)) {
                $instanceId = $instance->instanceId ?? $instance->InstanceId ?? $instance->instance_id ?? $instance->id ?? '';
            } elseif (is_array($instance)) {
                $instanceId = $instance['instanceId'] ?? $instance['InstanceId'] ?? $instance['instance_id'] ?? $instance['id'] ?? '';
            } else {
                echo "Instance is neither object nor array at index $index\n";
                continue;
            }
            
            if (empty($instanceId)) {
                echo "Instance ID not found for instance at index $index\n";
                continue; // 如果没有找到实例ID，跳过此实例
            }
            
            // 安全地获取实例名称
            $instanceName = $instance['instanceName'] ?? $instance['InstanceName'] ?? $instance['instance_name'] ?? $instance['name'] ?? 'Unknown';
            
            // 安全地获取状态
            $status = $instance['status'] ?? $instance['Status'] ?? $instance['State'] ?? 'Unknown';
            
            // 安全地获取CPU和内存
            $cpu = $instance['cpu'] ?? $instance['Cpu'] ?? $instance['CPU'] ?? 0;
            $memory = $instance['memory'] ?? $instance['Memory'] ?? $instance['MEM'] ?? 0;
            
            // 安全地获取实例类型
            $instanceType = $instance['instanceType'] ?? $instance['InstanceType'] ?? $instance['type'] ?? '';
            
            // 安全地获取VPC ID
            $vpcId = $instance['vpcId'] ?? $instance['VpcId'] ?? $instance['vpc_id'] ?? '';
            
            // 安全地获取操作系统信息
            $osType = $instance['osType'] ?? $instance['OsType'] ?? $instance['OSType'] ?? 'linux';
            $osName = $instance['osName'] ?? $instance['OsName'] ?? $instance['OSName'] ?? $instance['ImageId'] ?? $instance['imageId'] ?? 'Unknown';
            
            // 安全地获取创建时间和过期时间
            $creationTime = $instance['creationTime'] ?? $instance['CreationTime'] ?? $instance['CreatedTime'] ?? null;
            $expiredTime = $instance['expiredTime'] ?? $instance['ExpiredTime'] ?? $instance['ExpireTime'] ?? null;
            
            // 获取所有私有IP
            $privateIps = [];
            if (!empty($instance['innerIpAddress']) && !empty($instance['innerIpAddress']['ipAddress'])) {
                $privateIps = $instance['innerIpAddress']['ipAddress'];
            } elseif (!empty($instance['privateIpAddress']) && !empty($instance['privateIpAddress']['ipAddress'])) {
                $privateIps = $instance['privateIpAddress']['ipAddress'];
            } elseif (!empty($instance['vpcAttributes']['privateIpAddress']['ipAddress'])) {
                $privateIps = $instance['vpcAttributes']['privateIpAddress']['ipAddress'];
            }
            // 去重并保留唯一IP
            $privateIps = array_unique($privateIps);
            // 设置默认私有IP
            $privateIp = !empty($privateIps) ? reset($privateIps) : '0.0.0.0';
            
            // 获取所有公网IP
            $publicIps = [];
            if (!empty($instance['eipAddress']) && !empty($instance['eipAddress']['ipAddress'])) {
                $publicIps[] = $instance['eipAddress']['ipAddress'];
            } elseif (!empty($instance['publicIpAddress']) && !empty($instance['publicIpAddress']['ipAddress'])) {
                $publicIps = $instance['publicIpAddress']['ipAddress'];
            } elseif (!empty($instance['publicIpAddress']['ipAddress'])) {
                $publicIps = $instance['publicIpAddress']['ipAddress'];
            }
            // 去重并保留唯一IP
            $publicIps = array_unique($publicIps);
            // 设置默认公网IP
            $publicIp = !empty($publicIps) ? reset($publicIps) : '';
            
            // 获取MAC地址
            $macAddress = '';
            if (!empty($instance['networkInterfaces']) && is_array($instance['networkInterfaces']) && count($instance['networkInterfaces']) > 0) {
                if (isset($instance['networkInterfaces']['networkInterface']) && is_array($instance['networkInterfaces']['networkInterface'])) {
                    $firstInterface = $instance['networkInterfaces']['networkInterface'][0] ?? null;
                } else {
                    $firstInterface = $instance['networkInterfaces'][0] ?? null;
                }
                
                if ($firstInterface && isset($firstInterface['macAddress'])) {
                    $macAddress = $firstInterface['macAddress'];
                } elseif ($firstInterface && isset($firstInterface['mac_address'])) {
                    $macAddress = $firstInterface['mac_address'];
                }
            }
            
            // 获取安全组
            $securityGroups = [];
            if (!empty($instance['securityGroupIds']) && !empty($instance['securityGroupIds']['securityGroupId'])) {
                $securityGroups = $instance['securityGroupIds']['securityGroupId'];
            } elseif (!empty($instance['SecurityGroupIds']) && !empty($instance['SecurityGroupIds']['SecurityGroupId'])) {
                $securityGroups = $instance['SecurityGroupIds']['SecurityGroupId'];
            }
            
            // 构建主机资产数据
            $hosts[] = [
                'instance_id' => $instanceId,
                'instance_name' => $instanceName,
                'display_name' => $instanceName,
                'cloud_platform' => 'aliyun',
                'status' => strtoupper($status),
                'private_ip' => $privateIp,
                'public_ip' => $publicIp,
                'private_ips' => json_encode($privateIps),
                'public_ips' => json_encode($publicIps),
                'mac_address' => $macAddress,
                'os_type' => $osType,
                'os_name' => $osName,
                'cpu' => $cpu,
                'memory' => $memory,
                'instance_type' => $instanceType,
                'vpc_id' => $vpcId,
                'vpc_name' => '',
                'security_groups' => json_encode($securityGroups),
                'create_time' => !empty($creationTime) ? date('Y-m-d H:i:s', strtotime($creationTime)) : null,
                'update_time' => date('Y-m-d H:i:s'),
                'expire_time' => !empty($expiredTime) ? date('Y-m-d H:i:s', strtotime($expiredTime)) : null,
                'hids_installed' => 0,
                'original_data' => $instance // 保存原始实例数据
            ];
        }
        
        // 调试：打印hosts数组长度
        echo '阿里云主机数量: ' . count($hosts) . PHP_EOL;
        
        // 批量导入或更新
        foreach ($hosts as $index => $host) {
            // 调试：打印当前处理的主机
            echo '正在处理阿里云主机: ' . $host['instance_id'] . PHP_EOL;
            
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
            
            // 处理阿里云资源表
            $aliyunResource = [
                'resource_id' => $host['instance_id'],
                'resource_name' => $host['instance_name'],
                'resource_type' => 'ecs',
                'region' => env('ALIYUN.REGION_ID') ?? 'default',
                'status' => $host['status'],
                'public_ip' => $host['public_ip'],
                'public_ips' => $host['public_ips'],
                'private_ip' => $host['private_ip'],
                'private_ips' => $host['private_ips'],
                'original_json' => json_encode($host['original_data']), // 使用保存的原始数据
                'update_time' => date('Y-m-d H:i:s')
            ];
            
            // 调试：打印阿里云资源数据
            echo '阿里云资源数据: ' . json_encode($aliyunResource) . PHP_EOL;
            
            $existingAliyun = Db::table('asm_cloud_aliyun')->where('resource_id', $aliyunResource['resource_id'])->find();
            
            // 调试：打印existingAliyun
            echo '现有阿里云资源: ' . json_encode($existingAliyun) . PHP_EOL;
            
            if ($existingAliyun) {
                // 更新现有记录
                unset($aliyunResource['update_time']); // 不更新时间戳，由数据库自动处理
                $updateResult = Db::table('asm_cloud_aliyun')->where('id', $existingAliyun['id'])->update($aliyunResource);
                echo '更新阿里云资源结果: ' . $updateResult . PHP_EOL;
            } else {
                // 添加新记录
                $addResult = CloudModel::addAliyun($aliyunResource);
                echo '添加阿里云资源结果: ' . $addResult . PHP_EOL;
            }
        }
        
        return true;
    }

    // 从天翼云API数据导入主机资产
    public static function importFromTianyiApi($apiData, $teamId = 'A')
    {
        if (empty($apiData['returnObj']['results'])) {
            return false;
        }
        
        $hosts = [];
        foreach ($apiData['returnObj']['results'] as $instance) {
            // 获取所有私有IP
            $privateIps = [];
            if (!empty($instance['privateIP'])) {
                // 处理单个IP的情况
                $privateIps[] = $instance['privateIP'];
            }
            // 从addresses中获取所有私有IP
            if (!empty($instance['addresses'])) {
                foreach ($instance['addresses'] as $address) {
                    if (!empty($address['addressList'])) {
                        foreach ($address['addressList'] as $addr) {
                            if ($addr['type'] == 'fixed') {
                                $privateIps[] = $addr['ipAddress'];
                            }
                        }
                    }
                }
            }
            // 去重并保留唯一IP
            $privateIps = array_unique($privateIps);
            // 设置默认私有IP
            $privateIp = !empty($privateIps) ? reset($privateIps) : '0.0.0.0';
            
            // 获取所有公网IP
            $publicIps = [];
            if (!empty($instance['floatingIP'])) {
                // 处理单个IP的情况
                $publicIps[] = $instance['floatingIP'];
            }
            // 从addresses中获取所有公网IP
            if (!empty($instance['addresses'])) {
                foreach ($instance['addresses'] as $address) {
                    if (!empty($address['addressList'])) {
                        foreach ($address['addressList'] as $addr) {
                            if ($addr['type'] == 'floating') {
                                $publicIps[] = $addr['ipAddress'];
                            }
                        }
                    }
                }
            }
            // 去重并保留唯一IP
            $publicIps = array_unique($publicIps);
            // 设置默认公网IP
            $publicIp = !empty($publicIps) ? reset($publicIps) : '';
            
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
                'private_ips' => json_encode($privateIps),
                'public_ips' => json_encode($publicIps),
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
            
            // 构建天翼云资源表数据
            $tianyiResources[] = [
                'resource_id' => $instance['instanceID'],
                'resource_name' => $instance['instanceName'],
                'resource_type' => 'instance',
                'region' => $instance['regionName'] ?? '',
                'status' => $instance['instanceStatus'],
                'public_ip' => $publicIp,
                'private_ip' => $privateIp,
                'public_ips' => json_encode($publicIps),
                'private_ips' => json_encode($privateIps),
                'create_time' => date('Y-m-d H:i:s', strtotime($instance['createdTime'])),
                'update_time' => date('Y-m-d H:i:s', strtotime($instance['updatedTime'])),
                'original_json' => json_encode($instance, JSON_UNESCAPED_UNICODE),
                'team_id' => $teamId,
            ];
        }
        
        // 批量导入或更新
        foreach ($hosts as $index => $host) {
            $existing = self::getByInstanceIdAndPlatform($host['instance_id'], $host['cloud_platform']);
            if ($existing) {
                // 更新现有记录
                unset($host['create_time']); // 不更新创建时间
                self::updateByInstanceIdAndPlatform($host['instance_id'], $host['cloud_platform'], $host);
            } else {
                // 添加新记录
                self::addHostAssets($host);
            }
            
            // 处理天翼云资源表
            $tianyiResource = $tianyiResources[$index];
            $existingTianyi = Db::table('asm_cloud_tianyi')->where('resource_id', $tianyiResource['resource_id'])->find();
            
            if ($existingTianyi) {
                // 更新现有记录
                unset($tianyiResource['create_time']); // 不更新创建时间
                Db::table('asm_cloud_tianyi')->where('id', $existingTianyi['id'])->update($tianyiResource);
            } else {
                // 添加新记录
                Db::table('asm_cloud_tianyi')->insert($tianyiResource);
            }
        }
        
        return true;
    }
    
    // 从移动云API数据导入主机资产
    public static function importFromYidongApi($apiData)
    {

        if (empty($apiData)) {
            echo "移动云API数据错误\n";
            return false;
        }
        
        // 检查移动云API响应结构
        if (!isset($apiData['state']) || $apiData['state'] !== 'OK' || !isset($apiData['body']) || !isset($apiData['body']['content'])) {
            echo "移动云API数据错误\n 状态: {$apiData['state']}\n  ";
            return false;
        }
        
        // 提取实际的主机实例数据
        $instances = $apiData['body']['content'];
        
        $hosts = [];
        $yidongResources = [];
        
        foreach ($instances as $instance) {
            // 获取所有私有IP和公网IP
            $privateIps = [];
            $publicIps = [];
            
            if (isset($instance['port_detail']) && is_array($instance['port_detail'])) {
                foreach ($instance['port_detail'] as $port) {
                    if (isset($port['private_ip'])) {
                        $privateIps[] = $port['private_ip'];
                    }
                    if (isset($port['fip_address'])) {
                        $publicIps[] = $port['fip_address'];
                    }
                    if (isset($port['fixed_ip_detail_resps']) && is_array($port['fixed_ip_detail_resps'])) {
                        foreach ($port['fixed_ip_detail_resps'] as $ip_detail) {
                            if (isset($ip_detail['ip_address'])) {
                                $privateIps[] = $ip_detail['ip_address'];
                            }
                            if (isset($ip_detail['public_ip'])) {
                                $publicIps[] = $ip_detail['public_ip'];
                            }
                        }
                    }
                }
            }
            
            // 去重并保留唯一IP
            $privateIps = array_unique(array_filter($privateIps));
            $publicIps = array_unique(array_filter($publicIps));
            
            // 设置默认IP
            $privateIp = !empty($privateIps) ? reset($privateIps) : '0.0.0.0';
            $publicIp = !empty($publicIps) ? reset($publicIps) : '';
            
            // 获取MAC地址
            $macAddress = '';
            if (isset($instance['mac_address'])) {
                $macAddress = $instance['mac_address'];
            }
            
            // 获取安全组
            $securityGroups = [];
            if (isset($instance['security_groups']) && !empty($instance['security_groups'])) {
                if (is_array($instance['security_groups'])) {
                    foreach ($instance['security_groups'] as $sg) {
                        $securityGroups[] = [
                            'id' => $sg['security_group_id'] ?? $sg['id'] ?? '',
                            'name' => $sg['security_group_name'] ?? $sg['name'] ?? '',
                        ];
                    }
                }
            }
            
            $hosts[] = [
                'instance_id' => $instance['id'] ?? '',
                'instance_name' => $instance['name'] ?? '',
                'display_name' => $instance['name'] ?? '',
                'cloud_platform' => 'yidong',
                'status' => $instance['status'] ?? '',
                'private_ip' => $privateIp,
                'public_ip' => $publicIp,
                'private_ips' => json_encode($privateIps),
                'public_ips' => json_encode($publicIps),
                'mac_address' => $macAddress,
                'os_type' => $instance['image_os_type'] ?? 'Linux',
                'os_name' => $instance['image_name'] ?? 'Unknown',
                'cpu' => $instance['vcpu'] ?? 0,
                'memory' => $instance['vmemory'] ?? 0,
                'instance_type' => $instance['specs_name'] ?? '',
                'vpc_id' => $instance['port_detail'][0]['vpc_id'] ?? '',
                'vpc_name' => $instance['port_detail'][0]['vpc_name'] ?? '',
                'security_groups' => json_encode($securityGroups),
                'create_time' => date('Y-m-d H:i:s', strtotime($instance['created_time'] ?? '')),
                'update_time' => date('Y-m-d H:i:s'),
                'expire_time' => null,
                'hids_installed' => 0,
            ];
            
            // 构建移动云资源表数据
            $yidongResources[] = [
                'resource_id' => $instance['id'] ?? '',
                'resource_name' => $instance['name'] ?? '',
                'resource_type' => '云主机',
                'region' => $instance['region'] ?? '',
                'status' => $instance['status'] ?? '',
                'public_ip' => $publicIp,
                'private_ip' => $privateIp,
                'public_ips' => json_encode($publicIps),
                'private_ips' => json_encode($privateIps),
                'create_time' => date('Y-m-d H:i:s', strtotime($instance['created_time'] ?? '')),
                'update_time' => date('Y-m-d H:i:s'),
                'original_json' => json_encode($instance, JSON_UNESCAPED_UNICODE),
            ];
        }
        
        // 批量导入或更新
        foreach ($hosts as $index => $host) {
            $existing = self::getByInstanceIdAndPlatform($host['instance_id'], $host['cloud_platform']);
            if ($existing) {
                // 更新现有记录
                unset($host['create_time']); // 不更新创建时间
                self::updateByInstanceIdAndPlatform($host['instance_id'], $host['cloud_platform'], $host);
            } else {
                // 添加新记录
                self::addHostAssets($host);
            }
            
            // 处理移动云资源表
            $yidongResource = $yidongResources[$index];
            $existingYidong = Db::table('asm_cloud_yidong')->where('resource_id', $yidongResource['resource_id'])->find();

            if ($existingYidong) {
                // 更新现有记录
                unset($yidongResource['create_time']); // 不更新创建时间
                Db::table('asm_cloud_yidong')->where('id', $existingYidong['id'])->update($yidongResource);
            } else {
                // 添加新记录
                Db::table('asm_cloud_yidong')->insert($yidongResource);
            }
        }
        
        return true;
    }

    // 从百度云API数据导入主机资产
    public static function importFromBaiduApi($apiData)
    {
        if (empty($apiData)) {
            echo "百度云API数据错误\n";
            return false;
        }
        
        // 检查百度云API响应结构
        if (!isset($apiData['instances'])) {
            echo "百度云API数据错误\n 缺少instances字段\n";
            return false;
        }
        
        // 提取实际的主机实例数据
        $instances = $apiData['instances'];
        
        $hosts = [];
        $baiduResources = [];
        
        foreach ($instances as $instance) {
            // 获取所有私有IP和公网IP
            $privateIps = [];
            $publicIps = [];
            
            // 处理私有IP（优先从internal_ip获取，然后从nic_info.ips获取）
            if (!empty($instance['internal_ip'])) {
                $privateIps[] = $instance['internal_ip'];
            }
            
            if (isset($instance['nic_info']['ips']) && is_array($instance['nic_info']['ips'])) {
                foreach ($instance['nic_info']['ips'] as $ip_info) {
                    if (!empty($ip_info['private_ip'])) {
                        $privateIps[] = $ip_info['private_ip'];
                    }
                    if (!empty($ip_info['eip']) && $ip_info['eip'] !== 'null') {
                        $publicIps[] = $ip_info['eip'];
                    }
                }
            }
            
            // 处理公网IP
            if (!empty($instance['public_ip'])) {
                $publicIps[] = $instance['public_ip'];
            }
            
            // 去重并保留唯一IP
            $privateIps = array_unique(array_filter($privateIps));
            $publicIps = array_unique(array_filter($publicIps));
            
            // 设置默认IP
            $privateIp = !empty($privateIps) ? reset($privateIps) : '0.0.0.0';
            $publicIp = !empty($publicIps) ? reset($publicIps) : '';
            
            // 获取MAC地址
            $macAddress = '';
            if (isset($instance['nic_info']['mac_address'])) {
                $macAddress = $instance['nic_info']['mac_address'];
            }
            
            // 获取安全组
            $securityGroups = [];
            if (isset($instance['nic_info']['security_groups']) && is_array($instance['nic_info']['security_groups'])) {
                foreach ($instance['nic_info']['security_groups'] as $sg_id) {
                    $securityGroups[] = [
                        'id' => $sg_id,
                        'name' => $sg_id, // API返回的只有ID，没有名称
                    ];
                }
            }
            
            $hosts[] = [
                'instance_id' => $instance['id'] ?? '',
                'instance_name' => $instance['name'] ?? '',
                'display_name' => $instance['name'] ?? '',
                'cloud_platform' => 'baidu',
                'status' => $instance['status'] ?? '',
                'private_ip' => $privateIp,
                'public_ip' => $publicIp,
                'private_ips' => json_encode($privateIps),
                'public_ips' => json_encode($publicIps),
                'mac_address' => $macAddress,
                'os_type' => $instance['os_name'] ?? 'Linux',
                'os_name' => $instance['os_version'] ? $instance['os_name'] . ' ' . $instance['os_version'] : ($instance['os_name'] ?? 'Unknown'),
                'cpu' => $instance['cpu_count'] ?? 0,
                'memory' => $instance['memory_capacity_in_gb'] ?? 0,
                'instance_type' => $instance['instance_type'] ?? '',
                'vpc_id' => $instance['vpc_id'] ?? '',
                'vpc_name' => '', // API返回中没有vpc_name
                'security_groups' => json_encode($securityGroups),
                'create_time' => date('Y-m-d H:i:s', strtotime($instance['create_time'] ?? '')),
                'update_time' => date('Y-m-d H:i:s'),
                'expire_time' => isset($instance['expire_time']) ? date('Y-m-d H:i:s', strtotime($instance['expire_time'])) : null,
                'hids_installed' => 0,
            ];
            
            // 构建百度云资源表数据
            $baiduResources[] = [
                'resource_id' => $instance['id'] ?? '',
                'resource_name' => $instance['name'] ?? '',
                'resource_type' => '云主机',
                'region' => $instance['zone_name'] ?? '',
                'status' => $instance['status'] ?? '',
                'public_ip' => $publicIp,
                'private_ip' => $privateIp,
                'public_ips' => json_encode($publicIps),
                'private_ips' => json_encode($privateIps),
                'create_time' => date('Y-m-d H:i:s', strtotime($instance['create_time'] ?? '')),
                'update_time' => date('Y-m-d H:i:s'),
                'original_json' => json_encode($instance, JSON_UNESCAPED_UNICODE),
            ];
        }
        
        // 批量导入或更新
        foreach ($hosts as $index => $host) {
            $existing = self::getByInstanceIdAndPlatform($host['instance_id'], $host['cloud_platform']);
            if ($existing) {
                // 更新现有记录
                unset($host['create_time']); // 不更新创建时间
                self::updateByInstanceIdAndPlatform($host['instance_id'], $host['cloud_platform'], $host);
            } else {
                // 添加新记录
                self::addHostAssets($host);
            }
            
            // 处理百度云资源表
            $baiduResource = $baiduResources[$index];
            $existingBaidu = Db::table('asm_cloud_baidu')->where('resource_id', $baiduResource['resource_id'])->find();

            if ($existingBaidu) {
                // 更新现有记录
                unset($baiduResource['create_time']); // 不更新创建时间
                Db::table('asm_cloud_baidu')->where('id', $existingBaidu['id'])->update($baiduResource);
            } else {
                // 添加新记录
                Db::table('asm_cloud_baidu')->insert($baiduResource);
            }
        }
        
        return true;
    }
    
    // 主机资产统计数据
    public static function getHostAssetsStats()
    {
        $stats = [];
        
        // 总机器数量
        $stats['total_count'] = Db::table('asm_host_assets')->count();
        
        // 新增数量（最近7天）
        $stats['new_count'] = Db::table('asm_host_assets')
            ->where('create_time', '>=', date('Y-m-d H:i:s', strtotime('-7 days')))
            ->count();
        
        // HIDS安装状态统计
        $stats['hids_stats'] = Db::table('asm_host_assets')
            ->field('hids_installed, count(*) as count')
            ->group('hids_installed')
            ->select();
        
        // 云平台分布
        $stats['cloud_platform_stats'] = Db::table('asm_host_assets')
            ->field('cloud_platform, count(*) as count')
            ->group('cloud_platform')
            ->select();
        
        // 操作系统类型分布
        $stats['os_type_stats'] = Db::table('asm_host_assets')
            ->field('os_type, count(*) as count')
            ->where('os_type', '!=', '')
            ->group('os_type')
            ->select();
        
        // 状态分布
        $stats['status_stats'] = Db::table('asm_host_assets')
            ->field('status, count(*) as count')
            ->group('status')
            ->select();
        
        // 最近30天的新增趋势
        $trend = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $count = Db::table('asm_host_assets')
                ->whereDay('create_time', $date)
                ->count();
            $trend[] = [
                'date' => $date,
                'count' => $count
            ];
        }
        $stats['daily_trend'] = $trend;
        
        // 漏洞数量统计（通过vul_target表关联）
        $stats['vul_count'] = Db::name('vul_target')
            ->alias('vt')
            ->join('asm_host_assets ha', 'vt.ip = ha.private_ip')
            ->where('vt.is_vul', 1)
            ->count('DISTINCT vt.id');
        
        // 青藤HIDS数据统计
        $stats['qingteng_count'] = Db::table('asm_hids_qingteng')->count();
        
        // VPC分布
        $stats['vpc_stats'] = Db::table('asm_host_assets')
            ->field('vpc_name, count(*) as count')
            ->where('vpc_name', '!=', '')
            ->group('vpc_name')
            ->select();
        
        // 实例类型分布
        $stats['instance_type_stats'] = Db::table('asm_host_assets')
            ->field('instance_type, count(*) as count')
            ->where('instance_type', '!=', '')
            ->group('instance_type')
            ->select();
        
        // CPU核数分布
        $stats['cpu_stats'] = Db::table('asm_host_assets')
            ->field('cpu, count(*) as count')
            ->where('cpu', '>', 0)
            ->group('cpu')
            ->order('cpu', 'asc')
            ->select();
        
        // 各云平台主机总数和已安装HIDS数量对比
        $stats['cloud_platform_hids_stats'] = Db::table('asm_host_assets')
            ->field('cloud_platform, count(*) as total, sum(case when hids_installed = 1 then 1 else 0 end) as hids_installed')
            ->group('cloud_platform')
            ->select();
        
        return $stats;
    }
    
    // 从天翼云API数据导入主机资产
}