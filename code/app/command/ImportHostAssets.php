<?php
declare (strict_types=1);

namespace app\command;

use app\asm\model\HostAssetsModel;
use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\Output;
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
        $output->writeln("从天翼云API拉取主机资产功能开发中...");
        // 这里可以添加天翼云的实现逻辑
    }
}