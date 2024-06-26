{include file='public/head' /}
<div class="col-md-1 " style="padding-right: 0;" >
    {include file='public/whiteLeftMenu' /}
</div>
<div class="col-md-11 " style="padding:0;">
<?php
$dengjiArr = ['ERROR', 'Low', 'Medium', 'High', 'Critical'];

$fileList = str_replace('./extend/codeCheck/', '', $fileList);
$CategoryList = str_replace('data.tools.semgrep.', '', $CategoryList);
$fileTypeList = getFileType($fileList);
?>
<?php
$searchArr = [
    'action' => $_SERVER['REQUEST_URI'],
    'method' => 'get',
    'inputs' => [
        ['type' => 'text', 'name' => 'search', 'placeholder' => "搜索的内容"],
        ['type' => 'select', 'name' => 'level', 'options' => $dengjiArr, 'frist_option' => '危险等级'],
        ['type' => 'select', 'name' => 'Category', 'options' => $CategoryList, 'frist_option' => '漏洞类别'],
        ['type' => 'select', 'name' => 'code_id', 'options' => $projectList, 'frist_option' => '项目列表'],
        ['type' => 'select', 'name' => 'filename', 'options' => $fileList, 'frist_option' => '文件筛选'],
        ['type' => 'select', 'name' => 'filetype', 'options' => $fileTypeList, 'frist_option' => '文件后缀'],
        ['type' => 'select', 'name' => 'check_status', 'options' => $check_status_list, 'frist_option' => '审计状态', 'frist_option_value' => -1],
    ]];
?>
{include file='public/search' /}

<div class="row tuchu">
    <div class="col-md-12 ">
        {include file='public/batch' /}
        <table class="table  table-hover table-sm table-borderless">
            <thead class="table-light">
            <tr>
                <th width="80">
                    <label>
                        <input type="checkbox" value="-1" onclick="quanxuan(this)">ID
                    </label>
                </th>
                <th>所属项目</th>
                <th>漏洞类型</th>
                <th>危险等级</th>
                <th>污染来源</th>
                <th>扫描时间</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <?php foreach ($list as $value) {
                ?>
                <tr>
                    <td>
                        <label>
                            <input type="checkbox" class="ids" name="ids[]" value="<?php echo $value['id'] ?>">
                            <?php echo $value['id'] ?></label>
                    </td>
                    <td>
                        <a href="<?php echo url('code/index', ['id' => $value['code_id']]) ?>">
                            <?php echo isset($projectArr[$value['code_id']]) ? $projectArr[$value['code_id']]['name'] : '' ?></a>
                    </td>
                    <td><dvi title="<?php echo $value['check_id'] ?>"><?php  $tmpArr = explode(".", $value['check_id']); echo end($tmpArr) ?></dvi></td>
                    <td><?php echo $value['extra_severity'] ?></td>
                    <td><div title="<?php echo $value['path'] ?>"><?php echo basename($value['path']) ?></div></td>
                    <td><?php echo $value['create_time'] ?></td>
                    <td>
                        <select class="changCheckStatus form-select" data-id="<?php echo $value['id'] ?>">
                            <option value="0" <?php echo $value['check_status'] == 0 ? 'selected' : ''; ?> >未审核
                            </option>
                            <option value="1" <?php echo $value['check_status'] == 1 ? 'selected' : ''; ?> >有效漏洞
                            </option>
                            <option value="2" <?php echo $value['check_status'] == 2 ? 'selected' : ''; ?> >无效漏洞
                            </option>
                        </select>
                    </td>
                    <td>
                        <a href="<?php echo url('semgrep/details', ['id' => $value['id']]) ?>"
                           class="btn btn-sm btn-outline-secondary">查看详情</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    {include file='public/fenye' /}
</div>

<input type="hidden" id="to_examine_url" value="<?php echo url('to_examine/semgrep') ?>">
{include file='public/to_examine' /}

{include file='public/footer' /}