<?php
declare (strict_types=1);

namespace app\command;

use app\asm\model\HostAssetsModel;
use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\Output;
use Throwable;

class SyncHidsStatus extends Command
{
    protected function configure()
    {
        // 指令配置
        $this->setName('sync:hidsstatus')
            ->setDescription('同步青藤云HIDS主机状态，更新未安装HIDS的主机列表');
    }

    protected function execute(Input $input, Output $output): void
    {
        $output->writeln("开始执行青藤云HIDS状态同步任务");

        try {
            $this->syncFromQingTengHids($output);
            $output->writeln("<info>青藤云HIDS状态同步任务执行完成</info>");
        } catch (Throwable $e) {
            $output->writeln("<error>执行任务时发生错误: " . $e->getMessage() . "</error>");
            $output->writeln("<error>错误位置: " . $e->getFile() . ":" . $e->getLine() . "</error>");
        }
    }

    /**
     * 从青藤云HIDS拉取已安装主机列表并同步状态
     */
    private function syncFromQingTengHids(Output $output): void
    {
        $output->writeln("正在从青藤云HIDS API拉取已安装主机列表...");

        // 青藤云HIDS API配置，则从.env文件获取

        $hidsUrl = env('QINGTENG_HIDS.URL', '');
        $token = env('QINGTENG_HIDS.TOKEN', '');
        $timeout = env('QINGTENG_HIDS_TIMEOUT', 30);


        // 验证配置
        if (empty($hidsUrl) || empty($token)) {
            $output->writeln("<error>青藤云HIDS API配置缺失</error>");
            return;
        }

        try {
            // 初始化Guzzle客户端
            $client = new \GuzzleHttp\Client([
                'timeout' => $timeout,
                'verify' => false, // 禁用SSL验证（根据实际情况调整）
            ]);

            // 构建请求参数
            $requestData = [
                'query' => new \stdClass(),
                'size' => 1000, // 一次获取较多数据
                'page' => 0,
                'sort' => []
            ];

            // 发送请求
            $response = $client->post($hidsUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json',
                ],
                'json' => $requestData,
            ]);

            // 解析响应
            $responseBody = $response->getBody()->getContents();
            $data = json_decode($responseBody, true);

            if (!isset($data['data']) || !is_array($data['data'])) {
                $output->writeln("<error>青藤云HIDS API响应格式错误</error>");
                return;
            }

            $installedHosts = $data['data'];
            $output->writeln("<info>成功获取青藤云HIDS已安装主机列表，共 " . count($installedHosts) . " 台主机</info>");

            // 1. 首先将所有主机的HIDS状态标记为未安装
            HostAssetsModel::updateAll([
                'hids_installed' => 0
            ]);

            // 2. 然后更新已安装HIDS的主机状态
            $count = 0;
            foreach ($installedHosts as $host) {
                // 获取主机IP和名称
                $hostname = $host['hostname'] ?? '';
                $ip = $host['ip'] ?? '';
                $version = $host['version'] ?? '';

                // 查找匹配的主机资产
                $where = [];
                if ($ip) {
                    $where[] = ['private_ip', '=', $ip];
                    if ($ip != $host['ip']) {
                        $where[] = ['public_ip', '=', $ip];
                    }
                }

                if ($hostname) {
                    $where[] = ['instance_name', 'like', '%' . $hostname . '%'];
                }

                if (empty($where)) {
                    continue;
                }

                // 更新主机的HIDS状态
                $hostAssets = HostAssetsModel::getHostAssetsList($where, 1, 10);
                foreach ($hostAssets as $asset) {
                    HostAssetsModel::updateHidsStatus(
                        $asset['id'],
                        1, // 已安装
                        $version,
                        date('Y-m-d H:i:s') // 最后检查时间
                    );
                    $count++;
                }
            }

            $output->writeln("<info>共更新 " . $count . " 台主机的HIDS状态为已安装</info>");

            // 3. 统计未安装HIDS的主机数量
            $notInstalledCount = HostAssetsModel::getHostAssetsCount(['hids_installed' => 0]);
            $output->writeln("<info>当前未安装HIDS的主机数量: " . $notInstalledCount . " 台</info>");

        } catch (Throwable $e) {
            $output->writeln("<error>调用青藤云HIDS API失败: " . $e->getMessage() . "</error>");
            throw $e; // 重新抛出异常，让上层处理
        }
    }
}