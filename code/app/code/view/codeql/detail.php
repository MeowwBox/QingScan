{include file='public/head' /}
{include file='public/whiteLeftMenu' /}

<style>
    /* Tailwind 风格样式 */
    .page-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.04), 0 6px 20px 0 rgb(0 0 0 / 0.04);
    }
    .section-title {
        color: #64748b;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 12px;
    }
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }
    .info-item {
        background: #f8fafc;
        border-radius: 12px;
        padding: 16px;
    }
    .info-label {
        font-size: 11px;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 600;
    }
    .info-value {
        margin-top: 4px;
        color: #1e293b;
        font-weight: 500;
    }
    .code-container {
        background: #1e293b;
        border-radius: 12px;
        padding: 16px;
        overflow-x: auto;
        max-height: 380px;
    }
    .highlight {
        background-color: #fbbf24;
        color: #1e293b;
        padding: 0 2px;
        border-radius: 2px;
    }
    pre {
        white-space: pre-wrap;
        word-wrap: break-word;
        margin: 0;
    }
    .line-number {
        counter-increment: line;
    }
    .line-number::before {
        content: counter(line);
        display: inline-block;
        width: 2em;
        margin-right: 0.5em;
        text-align: right;
        color: #64748b;
    }
    .file-list-item {
        padding: 10px 14px;
        border-radius: 10px;
        transition: background-color 0.2s;
        list-style: none;
    }
    .file-list-item:hover {
        background: #f1f5f9;
    }
    .file-list-item.active {
        background: #eff6ff;
    }
    .file-link {
        font-size: 13px;
        color: #3b82f6;
        text-decoration: none;
    }
    .file-link:hover {
        text-decoration: underline;
    }
    .accordion-header {
        padding: 10px 14px;
        font-size: 13px;
        color: #64748b;
        background: #f8fafc;
        border-radius: 10px;
        border: none;
        width: 100%;
        text-align: left;
    }
    .accordion-header:hover {
        background: #f1f5f9;
    }
    .ai-analysis-box {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        border-radius: 12px;
        padding: 16px;
        font-size: 13px;
        color: #166534;
    }
    .vul-desc-box {
        background: #f8fafc;
        border-radius: 12px;
        padding: 16px;
        font-size: 13px;
        color: #64748b;
    }
    .page-title {
        color: #1e293b;
        font-weight: 600;
    }
    .page-subtitle {
        color: #94a3b8;
        font-size: 13px;
    }
</style>

<!-- Prism.js CSS 和 JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.28.0/themes/prism-tomorrow.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.28.0/prism.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.28.0/components/prism-python.min.js"></script>

<div class="page-card" style="margin: 20px;">
    <!-- 面包屑导航 -->
    <div style="padding: 16px 20px; border-bottom: 1px solid #f1f5f9;">
        <nav class="breadcrumb">
            <a href="/code/codeql/index.html" style="color: #64748b; text-decoration: none;">CodeQL列表</a>
            <span style="color: #94a3b8; margin: 0 8px;">/</span>
            <span style="color: #1e293b; font-weight: 500;">漏洞详情</span>
        </nav>
    </div>

    <!-- 页面标题 -->
    <div style="padding: 20px 24px; border-bottom: 1px solid #f1f5f9;">
        <h5 class="page-title" style="margin: 0;">
            <span>{$info['ruleId']}</span>
        </h5>
        <p class="page-subtitle" style="margin: 4px 0 0;">{$info['create_time']}</p>
    </div>

    <div class="flex flex-wrap" style="margin: 0;">
        <!-- 左侧：代码位置和数据流转 -->
        <div class="w-full lg:w-[240px] flex-shrink-0" style="padding: 20px; border-right: 1px solid #f1f5f9;">
            <p class="section-title">代码位置</p>
            <ul style="padding: 0; margin: 0;">
                <?php if (!empty($info['locations'])) { ?>
                    <?php foreach ($info['locations'] as $result) { ?>
                        <li class="file-list-item">
                            <a href="#" class="file-link click_a"
                               onclick="showFile('<?php echo $result['file']; ?>', <?php echo $result['start_line']; ?>, <?php echo $result['start_column']; ?>, <?php echo $result['end_column']; ?>); return false;">
                                <?php echo basename($result['file']); ?>: <?php echo $result['start_line']; ?>,
                                <?php echo $result['start_column']; ?>-<?php echo $result['end_column']; ?>
                            </a>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>

            <br>
            <p class="section-title">数据流转</p>
            <div class="space-y-2" id="accordionExample">
                <?php if (!empty($info['codeFlows'])) { ?>
                    <?php foreach ($info['codeFlows'] as $k => $result) { ?>
                                <details class="group" style="border: none;">
                                    <summary class="accordion-header cursor-pointer list-none">
                                        第 <?php echo $k+1; ?> 条路径
                                    </summary>
                                    <div class="mt-2">
                                        <ul style="padding: 0; margin: 8px 0;">
                                            <?php if (!empty($result['threadFlows'])) { ?>
                                                <?php foreach ($result['threadFlows'] as $item) { ?>
                                                    <?php if (!empty($item['locations'])) { ?>
                                                        <?php foreach ($item['locations'] as $val) { ?>
                                                            <?php if (!empty($val['location'])) { ?>
                                                                <?php foreach ($val['location'] as $v) { ?>
                                                                    <li class="file-list-item">
                                                                        <a href="#" class="file-link click_a"
                                                                           onclick="showFile('<?php echo $v['file']; ?>', <?php echo $v['start_line']; ?>, <?php echo $v['start_column']; ?>, <?php echo $v['end_column']; ?>); return false;">
                                                                            <?php echo basename($v['file']); ?>
                                                                            : <?php echo $v['start_line']; ?>,
                                                                            <?php echo $v['start_column']; ?>
                                                                            -<?php echo $v['end_column']; ?>
                                                                        </a>
                                                                    </li>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    <?php } ?>
                                                <?php } ?>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </details>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>

                <!-- 右侧：代码详情和分析 -->
                <div class="flex-1 min-w-0" style="padding: 20px;">
                    <p class="section-title">代码详情</p>
                    <div id="code-container" class="code-container">
                        <pre id="code" class="line-number" style="color: #e2e8f0;"></pre>
                    </div>
                    <br>

                    <div class="flex flex-wrap -mx-4">
                        <div class="w-full lg:w-1/2 px-4">
                            <p class="section-title">漏洞说明</p>
                            <div class="vul-desc-box">
                                <?php echo $info['prompt'] ?>
                            </div>
                        </div>
                        <div class="w-full lg:w-1/2 px-4">
                            <p class="section-title">AI分析</p>
                            <div class="ai-analysis-box">
                                <div id="markdown-content"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/static/js/marked.min.js"></script>
<script>
    $(".codeql_index").addClass("nav_li_hover");

    function b64DecodeUnicode(encodedData) {
        return decodeURIComponent(atob(encodedData).split('').map(function (c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join(''));
    }

    const markdownContent = b64DecodeUnicode('<?php echo base64_encode($info['ai_message']) ?>');
    document.getElementById("markdown-content").innerHTML = marked.parse(markdownContent);

    $(".click_a").click(function () {
        $('.file-list-item').removeClass('active');
        $(this).closest('li').addClass('active');
    });

    const showFile = (filePath, startLine, startColumn, endColumn) => {
        fetch(`/code/codeql/readFile?file=` + filePath, {headers: {'Content-Type': 'application/json'}})
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                    return;
                }

                const decodedContent = b64DecodeUnicode(data.content);
                const lines = decodedContent.split('\n');
                let codeHtml = '';
                lines.forEach((line, index) => {
                    const lineNumber = index + 1;
                    let lineHtml = Prism.highlight(line, Prism.languages.python, 'python');
                    if (lineNumber === startLine) {
                        lineHtml = line.slice(0, startColumn - 1) +
                            '<span class="highlight">' +
                            line.slice(startColumn - 1, endColumn) +
                            '</span>' +
                            line.slice(endColumn);
                    }
                    codeHtml += '<div class="line-number">' + lineHtml + '</div>\n';
                });
                const codeContainer = document.getElementById('code');
                codeContainer.innerHTML = '<pre><code class="language-python">' + codeHtml + '</code></pre>';

                // 滚动到高亮行
                const highlightedElement = document.querySelector('.highlight');
                if (highlightedElement) {
                    highlightedElement.scrollIntoView({behavior: 'smooth', block: 'center'});
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    };
</script>
{include file='public/footer' /}
