<?php

$inputs = $searchArr['inputs'];
$btnArr = $searchArr['btnArr'] ?? [];
?>
<style>
    .search-container {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.04), 0 6px 20px 0 rgb(0 0 0 / 0.04);
        margin-bottom: 24px;
    }
    .search-container .form-control {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 10px 16px;
        color: #1e293b;
        font-size: 14px;
        min-width: 180px;
        transition: all 0.2s ease;
    }
    .search-container .form-control::placeholder {
        color: #94a3b8;
    }
    .search-container .form-control:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        outline: none;
        background: #ffffff;
    }
    .search-container .form-select {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 10px 36px 10px 16px;
        color: #1e293b;
        font-size: 14px;
        min-width: 140px;
        cursor: pointer;
        transition: all 0.2s ease;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%2364748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 12px center;
        background-repeat: no-repeat;
        background-size: 16px 12px;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }
    .search-container .form-select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        outline: none;
        background-color: #ffffff;
    }
    .search-container .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        border: none;
        border-radius: 12px;
        padding: 10px 20px;
        color: #ffffff;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .search-container .btn-primary:hover {
        box-shadow: 0 4px 12px -2px rgb(0 0 0 / 0.1);
        transform: translateY(-1px);
    }
    .search-container .btn-secondary {
        background: transparent;
        border: 1px solid #cbd5e1;
        border-radius: 12px;
        padding: 10px 20px;
        color: #1e293b;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .search-container .btn-secondary:hover {
        background: #f8fafc;
        border-color: #3b82f6;
        color: #3b82f6;
    }
    .search-container .btn-action {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        border: none;
        border-radius: 12px;
        padding: 10px 20px;
        color: #ffffff;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .search-container .btn-action:hover {
        box-shadow: 0 4px 12px -2px rgb(0 0 0 / 0.1);
        transform: translateY(-1px);
        color: #ffffff;
    }
    .search-container .form-label {
        font-size: 14px;
        font-weight: 500;
        color: #64748b;
        margin-bottom: 8px;
    }
    .search-container .input-group {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        align-items: flex-end;
    }
    .search-container .input-wrapper {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .search-container .btn-group {
        display: flex;
        gap: 12px;
        margin-left: auto;
    }
</style>
<div class="search-container">
    <form class="input-group" method="<?php echo $searchArr['method'] ?>"
          action="<?php echo $searchArr['action'] ?>">
        <?php foreach ($inputs as $inputInfo) { ?>
            <?php
            //下拉框处理
            if ($inputInfo['type'] == 'select') { ?>
                <div class="input-wrapper">
                    <?php if (!empty($inputInfo['label'])) { ?>
                        <label class="form-label"><?php echo $inputInfo['label'] ?></label>
                    <?php } ?>
                    <select class="form-select" name="<?php echo $inputInfo['name'] ?>">
                        <option value="<?php echo $inputInfo['frist_option_value'] ?? '' ?>" <?php echo empty($inputInfo['options']) ? 'selected' : '' ?>>
                            <?php echo $inputInfo['frist_option'] ?>
                        </option>
                        <?php foreach (array_filter($inputInfo['options']) as $key => $value) {
                            if (array_is_map($inputInfo['options'])) { ?>
                                <option value="<?php echo $key ?>" <?php echo (($_GET[$inputInfo['name']] ?? '') == $key) ? 'selected' : '' ?>><?php echo htmlspecialchars($value) ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $value ?>" <?php echo (($_GET[$inputInfo['name']] ?? '') == $value) ? 'selected' : '' ?>><?php echo htmlspecialchars($value) ?></option>
                            <?php }
                        } ?>
                    </select>
                </div>
                <?php
                //普通input处理
            } elseif ($inputInfo['type'] == 'text') { ?>
                <div class="input-wrapper">
                    <?php if (!empty($inputInfo['label'])) { ?>
                        <label class="form-label"><?php echo $inputInfo['label'] ?></label>
                    <?php } ?>
                    <input type="<?php echo $inputInfo['type'] ?>" class="form-control" name="<?php echo $inputInfo['name'] ?>"
                           value="<?php echo $inputInfo['value'] ?? strip_tags($_GET['search'] ?? '') ?>"
                           placeholder="<?php echo $inputInfo['placeholder'] ?? '' ?>">
                </div>
            <?php } ?>
        <?php } ?>
        <?php if (!empty($inputs)) { ?>
            <div class="btn-group">
                <button type="submit" class="btn-primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    搜索
                </button>
                <button type="button" class="btn-secondary" onclick="location.href='<?php echo $searchArr['action'] ?>'">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4v5h.582m15.356 2A8.001 8.001 0 0 0 4.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 0 1-15.357-2m15.357 2H15"></path>
                    </svg>
                    重置
                </button>
            </div>
        <?php } ?>
    </form>
    <?php if (!empty($btnArr)) { ?>
        <div style="display: flex; gap: 12px; margin-top: 16px; padding-top: 16px; border-top: 1px solid #e2e8f0;">
            <?php foreach ($btnArr as $value) { ?>
                <a <?php foreach ($value['ext'] ?? [] as $key => $val) {
                    echo "$key='$val'";
                } ?> class="btn-action">
                    <?php if (!empty($value['icon'])) { ?>
                        <?php echo $value['icon']; ?>
                    <?php } ?>
                    <?php echo $value['text'] ?>
                </a>
            <?php } ?>
        </div>
    <?php } ?>
</div>
