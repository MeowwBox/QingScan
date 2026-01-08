<?php
declare (strict_types=1);

namespace app\command;

use app\asm\model\CloudModel;
use app\asm\model\HostAssetsModel;
use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\Output;
use think\facade\Db;
use Throwable;
use Volcengine\Common\Configuration;
use Volcengine\Ecs\Api\ECSApi;
use Volcengine\Ecs\Model\DescribeInstancesRequest;

class ImportHostAssets extends Command
{
    protected function configure()
    {
        // 指令配置
        $this->setName('import:hostassets')
            ->addArgument("platform", Argument::OPTIONAL, "云平台类型", "huoshan")
            ->setDescription('定时拉取云平台主机资产列表');
    }

    protected function execute(Input $input, Output $output): void
    {
        $platform = trim($input->getArgument('platform'));
        $output->writeln("开始执行主机资产拉取任务，平台：{$platform}");

        try {
            if ($platform === 'huoshan') {
                $this->importFromHuoshan($output);
            } elseif ($platform === 'tianyi') {
                $this->importFromTianyi($output);
            } else {
                $output->writeln("<error>不支持的云平台类型：{$platform}</error>");
                return;
            }

            $output->writeln("<info>主机资产拉取任务执行完成</info>");
        } catch (Throwable $e) {
            $output->writeln("<error>执行任务时发生错误: " . $e->getMessage() . "</error>");
            $output->writeln("<error>错误位置: " . $e->getFile() . ":" . $e->getLine() . "</error>");
        }
    }

    /**
     * 从火山云拉取主机资产
     */
    private function importFromHuoshan(Output $output): void
    {
        $output->writeln("正在从火山云API拉取主机资产...");


        // 从配置获取火山云AK/SK
        if (empty(env('HUOSHAN.AK')) || empty(env('HUOSHAN.SK'))) {
            $output->writeln("<error>火山云AK/SK配置缺失</error>");
            return;
        }

        // 初始化火山云SDK
        $configuration = Configuration::getDefaultConfiguration()
            ->setAk(env('HUOSHAN.AK'))
            ->setSk(env('HUOSHAN.SK'))
            ->setRegion(env('HUOSHAN.REGION') ?? 'cn-beijing');

        // 解决PHP 8.1+兼容性问题
        $client = new \GuzzleHttp\Client();
        $configInstance = $configuration;
        $selector = new \Volcengine\Common\HeaderSelector();

        // 使用反射创建ECSApi实例，避免构造函数参数类型问题
        $apiInstance = new \Volcengine\Ecs\Api\ECSApi($client, $configInstance, $selector);
        $describeInstancesRequest = new DescribeInstancesRequest();

        // 调用API获取实例列表
        try {
            $response = $apiInstance->describeInstances($describeInstancesRequest);

            // 检查API响应是否成功
            if (!isset($response)) {
                $output->writeln("<error>火山云API无响应</error>");
                return;
            }

            // 根据响应类型处理数据
            if (is_object($response)) {
                // 使用对象的getter方法直接获取数据
                if (method_exists($response, 'getInstances')) {
                    $instances = $response->getInstances();
                    $instanceCount = is_array($instances) ? count($instances) : 0;
                    $output->writeln("<info>成功获取火山云主机实例列表，共 " . $instanceCount . " 台主机</info>");

                    // 检查是否有数据需要导入
                    if ($instanceCount > 0) {
                        // 使用反射和getter方法将所有实例转换为数组
                        $instancesArray = [];
                        foreach ($instances as $instance) {
                            $instanceArray = [];
                            $reflection = new \ReflectionClass($instance);
                            $methods = $reflection->getMethods(\ReflectionMethod::IS_PUBLIC);

                            foreach ($methods as $method) {
                                $methodName = $method->getName();
                                // 只处理getter方法
                                if (strpos($methodName, 'get') === 0 && $methodName !== 'getModelName') {
                                    // 调用getter方法获取属性值
                                    $value = $method->invoke($instance);
                                    // 将getter方法名转换为驼峰式的属性名
                                    $propertyName = lcfirst(substr($methodName, 3));
                                    $instanceArray[$propertyName] = $value;
                                }
                            }

                            $instancesArray[] = $instanceArray;
                        }

                        // 创建符合HostAssetsModel预期格式的数组
                        $formattedResponse = [
                            'Result' => [
                                'Instances' => $instancesArray
                            ]
                        ];

                        HostAssetsModel::importFromHuoshanApi($formattedResponse);
                    }
                } else {
                    $output->writeln("<error>火山云API响应对象没有getInstances方法</error>");
                    return;
                }
            } else if (is_array($response)) {
                // 如果是数组，保持原处理方式
                if (!isset($response['Result']) || !is_array($response['Result'])) {
                    $output->writeln("<error>火山云API响应中缺少Result字段</error>");
                    return;
                }

                if (!isset($response['Result']['Instances']) || !is_array($response['Result']['Instances'])) {
                    $output->writeln("<error>火山云API响应中缺少Instances字段</error>");
                    return;
                }

                $instanceCount = count($response['Result']['Instances']);
                $output->writeln("<info>成功获取火山云主机实例列表，共 " . $instanceCount . " 台主机</info>");

                // 导入到数据库
                HostAssetsModel::importFromHuoshanApi($response);
            } else {
                $output->writeln("<error>火山云API响应格式未知</error>");
                return;
            }

            $output->writeln("<info>火山云主机资产导入数据库完成</info>");
        } catch (Throwable $e) {
            $output->writeln("<error>调用火山云API失败: " . $e->getMessage() . "</error>");
            throw $e; // 重新抛出异常，让上层处理
        }
    }

    /**
     * 从天翼云拉取主机资产
     */
    private function importFromTianyi(Output $output): void
    {
        $output->writeln("正在从天翼云API拉取主机资产...");

        var_dump(env('TIANYI.AK'));
        // 从配置获取天翼云相关参数
        if (empty(env('TIANYI.AK')) || empty(env('TIANYI.SK'))) {
            $output->writeln("<error>天翼云AK/SK配置缺失</error>");
            return;
        }

        // 获取天翼云配置
        $accessKeyId = env('TIANYI.AK');
        $secretAccessKey = env('TIANYI.SK');
        $regionId = env('TIANYI.REGION_ID'); // 默认区域ID
        $endpoint = env('TIANYI.ENDPOINT') ?? 'ctecs-global.ctapi.ctyun.cn';
        $resourcePath = env('TIANYI.RESOURCE_PATH') ?? '/v4/ecs/list-instances';

        // 使用天翼云API客户端类进行请求
        $response = $this->callTianyiApi($accessKeyId, $secretAccessKey, $regionId, $endpoint, $resourcePath);

        if ($response['error']) {
            $output->writeln("<error>天翼云API请求失败: " . $response['error'] . "</error>");
            return;
        }

        if ($response['status_code'] != 200) {
            $output->writeln("<error>天翼云API响应错误，状态码: " . $response['status_code'] . "</error>");
            return;
        }

        // 解析API响应
        $apiResponse = json_decode($response['body'], true);


        if (json_last_error() !== JSON_ERROR_NONE) {
            $output->writeln("<error>解析天翼云API响应失败: " . json_last_error_msg() . "</error>");
            return;
        }

        // 检查API响应格式并提取实例数据
        $instances = [];
        if (isset($apiResponse['returnObj']['results']) && is_array($apiResponse['returnObj']['results'])) {
            $instances = $apiResponse['returnObj']['results'];
        } elseif (isset($apiResponse['instances']) && is_array($apiResponse['instances'])) {
            $instances = $apiResponse['instances'];
        } elseif (isset($apiResponse['data']) && is_array($apiResponse['data'])) {
            $instances = $apiResponse['data'];
        } else {
            // 根据实际API响应结构进行调整
            $instances = [$apiResponse]; // 单个实例的情况
        }

        $instanceCount = count($instances);
        $output->writeln("<info>成功获取天翼云主机实例列表，共 " . $instanceCount . " 台主机</info>");

        if ($instanceCount > 0) {
            // 准备天翼云资源数据并导入数据库
            $tianyiResources = [];
            $hosts = [];

            foreach ($instances as $instance) {
                // 处理实例数据，映射到系统所需字段
                $resourceId = $instance['instanceID'] ?? $instance['id'] ?? $instance['uuid'] ?? uniqid('tianyi_');
                $resourceName = $instance['instanceName'] ?? $instance['name'] ?? $instance['displayName'] ?? 'Unknown';
                $resourceType = $instance['resourceType'] ?? $instance['type'] ?? $instance['instanceType'] ?? '云主机';
                $region = $instance['region'] ?? env('TIANYI.REGION_ID') ?? 'default';
                $status = strtoupper($instance['status'] ?? $instance['instanceStatus'] ?? 'unknown');
                $publicIp = $instance['publicIp'] ?? $instance['floatingIP'] ?? $instance['eip'] ?? '';
                $privateIp = $instance['privateIp'] ?? $instance['privateIPAddress'] ?? $instance['innerIP'] ?? '0.0.0.0';
                // 使用convertDatetime方法处理创建时间
                $createTime = $this->convertDatetime($instance['createTime'] ?? $instance['create_time'] ?? $instance['createdTime'] ?? null) ?? date('Y-m-d H:i:s');

                // 天翼云资源表数据
                $tianyiResources[] = [
                    'resource_id' => $resourceId,
                    'resource_name' => $resourceName,
                    'resource_type' => $resourceType,
                    'region' => $region,
                    'status' => $status,
                    'public_ip' => $publicIp,
                    'private_ip' => $privateIp,
                    'create_time' => $createTime,
                    'update_time' => date('Y-m-d H:i:s'),
                ];

                // 主机资产表数据
                $hosts[] = [
                    'instance_id' => $resourceId,
                    'instance_name' => $resourceName,
                    'display_name' => $resourceName,
                    'cloud_platform' => 'tianyi',
                    'status' => $status,
                    'private_ip' => $privateIp,
                    'public_ip' => $publicIp,
                    'mac_address' => $instance['macAddress'] ?? $instance['mac'] ?? '',
                    'os_type' => $instance['osType'] ?? $instance['os'] ?? 'Unknown',
                    'os_name' => $instance['osName'] ?? $instance['imageName'] ?? 'Unknown',
                    'cpu' => $instance['cpu'] ?? $instance['vCPU'] ?? 0,
                    'memory' => $instance['memory'] ?? $instance['ram'] ?? 0,
                    'instance_type' => $resourceType,
                    'vpc_id' => $instance['vpcId'] ?? $instance['vpcID'] ?? '',
                    'vpc_name' => $instance['vpcName'] ?? '',
                    'security_groups' => json_encode($instance['securityGroups'] ?? $instance['securityGroupList'] ?? []),
                    'create_time' => $createTime,
                    'update_time' => date('Y-m-d H:i:s'),
                    // 处理过期时间格式，将ISO 8601格式转换为MySQL datetime格式
                    'expire_time' => $this->convertDatetime($instance['expireTime'] ?? $instance['expiredTime'] ?? null),
                    'hids_installed' => 0,
                ];
            }

            // 批量导入或更新天翼云资源数据
            foreach ($tianyiResources as $resource) {
                $existing =Db::table('asm_cloud_tianyi')->where('resource_id', $resource['resource_id'])->find();
                if ($existing) {
                    // 更新现有记录
                    unset($resource['create_time']); // 不更新创建时间
                   Db::table('asm_cloud_tianyi')->where('id', $existing['id'])->update($resource);
                } else {
                    // 添加新记录
                    CloudModel::addTianyi($resource);
                }
            }

            // 导入到主机资产总表
            foreach ($hosts as $host) {
                $existing = HostAssetsModel::getByInstanceIdAndPlatform($host['instance_id'], $host['cloud_platform']);
                if ($existing) {
                    // 更新现有记录
                    unset($host['create_time']); // 不更新创建时间
                    HostAssetsModel::updateByInstanceIdAndPlatform($host['instance_id'], $host['cloud_platform'], $host);
                } else {
                    // 添加新记录
                    HostAssetsModel::addHostAssets($host);
                }
            }
        }

        $output->writeln("<info>天翼云主机资产导入数据库完成</info>");

    }

    /**
     * 转换日期时间格式
     * 将ISO 8601格式转换为MySQL datetime格式
     */
    private function convertDatetime($datetime)
    {
        if (empty($datetime)) {
            return null;
        }

        // 尝试解析常见的ISO 8601格式
        $formats = [
            'Y-m-d\TH:i:s.u\Z', // 带微秒的UTC格式
            'Y-m-d\TH:i:s\Z',   // 不带微秒的UTC格式
            'Y-m-d\TH:i:s.uP',  // 带微秒的时区偏移格式
            'Y-m-d\TH:i:sP',    // 不带微秒的时区偏移格式
            'Y-m-d H:i:s.u',     // 带微秒的普通格式
            'Y-m-d H:i:s',       // 普通格式
        ];

        foreach ($formats as $format) {
             $dt = \DateTime::createFromFormat($format, $datetime);
             if ($dt !== false) {
                 return $dt->format('Y-m-d H:i:s');
             }
         }

        // 最后的尝试：使用strtotime
        $timestamp = strtotime($datetime);
        if ($timestamp === false) {
            return null;
        }

        return date('Y-m-d H:i:s', $timestamp);
    }

    /**
     * 调用天翼云API
     */
    private function callTianyiApi($ak, $sk, $regionId, $endpoint, $resourcePath)
    {
        // 生成32位的ctyun-eop-request-id（UUID4）
        $requestId = sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );

        // 生成EOP日期
        date_default_timezone_set('Asia/Shanghai');
        $eopDate = date('Ymd\THis\Z');

        // 构建请求体
        $requestBody = [
            "regionID" => $regionId
        ];

        // 计算数据的SHA256摘要
        $bodySha256Hex = hash('sha256', json_encode($requestBody, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

        // 构造待签名字符串
        $headerStr = "ctyun-eop-request-id:{$requestId}\n" . "eop-date:{$eopDate}\n";
        $encodedQuery = "";
        $signatureBase = "{$headerStr}\n{$encodedQuery}\n{$bodySha256Hex}";

        // 计算动态密钥
        $ktime = hash_hmac('sha256', $eopDate, $sk, true);
        $kAk = hash_hmac('sha256', $ak, $ktime, true);
        $datePart = substr($eopDate, 0, 8); // 提取日期部分
        $kdate = hash_hmac('sha256', $datePart, $kAk, true);

        // 计算签名
        $signature = hash_hmac('sha256', $signatureBase, $kdate, true);
        $signatureB64 = base64_encode($signature);

        // 构造Eop-Authorization
        $eopAuthorization = "{$ak} Headers=ctyun-eop-request-id;eop-date Signature={$signatureB64}";

        // 构建完整URL
        $fullUrl = "https://{$endpoint}{$resourcePath}";

        // 构造请求头
        $headers = [
            "host: {$endpoint}",
            "User-Agent: Mozilla/5.0(QingScan)",
            "Eop-date: {$eopDate}",
            "ctyun-eop-request-id: {$requestId}",
            "Eop-Authorization: {$eopAuthorization}",
            "Content-Type: application/json;charset=UTF-8"
        ];

        // 初始化cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $fullUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestBody, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        // 生产环境建议开启SSL验证
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        // 执行请求
        $responseBody = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        return [
            'status_code' => $statusCode,
            'body' => $responseBody,
            'error' => $error
        ];
    }
}