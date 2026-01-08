<?php
declare (strict_types=1);

namespace app\command;

use app\asm\model\CloudModel;
use app\asm\model\HostAssetsModel;
use app\asm\model\HostAssetsSyncModel;
use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\Output;
use think\facade\Db;
use Throwable;
use Volcengine\Common\Configuration;
use Volcengine\Ecs\Api\ECSApi;
use Volcengine\Ecs\Model\DescribeInstancesRequest;

class Asm extends Command
{
    protected function configure()
    {
        // 指令配置
        Asm::setName('asm')
            ->addArgument("platform", Argument::OPTIONAL, "云平台类型", "huoshan")
            ->setDescription('定时拉取云平台主机资产列表');
    }

    protected function execute(Input $input, Output $output): void
    {
        $platform = trim($input->getArgument('platform'));
        $output->writeln("开始执行主机资产拉取任务，平台：{$platform}");

        if ($platform === 'huoshan') {
            HostAssetsSyncModel::importFromHuoshan($output);
        } elseif ($platform === 'tianyi') {
            HostAssetsSyncModel::importFromTianyi($output);
        } elseif ($platform === 'qingteng') {
            HostAssetsSyncModel::syncFromQingTengHids($output);
            $output->writeln("<info>青藤云HIDS状态同步任务执行完成</info>");
        } else {
            $output->writeln("<error>不支持的云平台类型：{$platform}</error>");
            return;
        }

    }


}