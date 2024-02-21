<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function themeConfig($form)
{
    $version = themeVersion();
    $str1 = explode('/themes/', Helper::options()->themeUrl);
    $str2 = explode('/', $str1[1]);
    $name = $str2[0];
    $db = Typecho_Db::get();
    $sjdq = $db->fetchRow($db->select()->from('table.options')->where('name = ?', 'theme:' . $name));
    $ysj = $sjdq['value'];
    if (isset($_POST['type'])) {
        if ($_POST["type"] == "备份模板") {
            if ($db->fetchRow($db->select()->from('table.options')->where('name = ?', 'theme:' . $name . 'bf'))) {
                $update = $db->update('table.options')->rows(array('value' => $ysj))->where('name = ?', 'theme:' . $name . 'bf');
                $updateRows = $db->query($update);
                ?>
                <script>
                    let flag = confirm("备份更新成功!");
                    if (flag || !flag) window.location.href = '<?php Helper::options()->adminUrl('options-theme.php');?>'
                </script>'
                <?php
            } else {
                if ($ysj) {
                    $insert = $db->insert('table.options')
                        ->rows(array('name' => 'theme:' . $name . 'bf', 'user' => '0', 'value' => $ysj));
                    $insertId = $db->query($insert);
                    ?>
                    <script>
                        let flag = confirm("备份成功!");
                        if (flag || !flag) window.location.href = '<?php Helper::options()->adminUrl('options-theme.php');?>'
                    </script>
                    <?php
                }
            }
        }
        if ($_POST["type"] == "还原模板") {
            if ($db->fetchRow($db->select()->from('table.options')->where('name = ?', 'theme:' . $name . 'bf'))) {
                $sjdub = $db->fetchRow($db->select()->from('table.options')->where('name = ?', 'theme:' . $name . 'bf'));
                $bsj = $sjdub['value'];
                $update = $db->update('table.options')->rows(array('value' => $bsj))->where('name = ?', 'theme:' . $name);
                $updateRows = $db->query($update);
                ?>
                <script>
                    let flag = confirm("恢复成功！");
                    if (flag || !flag) window.location.href = '<?php Helper::options()->adminUrl('options-theme.php');?>'
                </script>
                <?php
            } else {
                ?>
                <script>
                    let flag = confirm("未备份过数据，无法恢复！");
                    if (flag || !flag) window.location.href = '<?php Helper::options()->adminUrl('options-theme.php');?>'
                </script>
                <?php
            }
        }
        if ($_POST["type"] == "删除备份") {
            if ($db->fetchRow($db->select()->from('table.options')->where('name = ?', 'theme:' . $name . 'bf'))) {
                $delete = $db->delete('table.options')->where('name = ?', 'theme:' . $name . 'bf');
                $deletedRows = $db->query($delete);
                ?>
                <script>
                    let flag = confirm("删除成功！");
                    if (flag || !flag) window.location.href = '<?php Helper::options()->adminUrl('options-theme.php');?>'
                </script> 2500);</script>
                <?php
            } else {
                ?>
                <script>
                    let flag = confirm("没有备份内容，无法删除！");
                    if (flag || !flag) window.location.href = '<?php Helper::options()->adminUrl('options-theme.php');?>'
                </script>
                <?php
            }
        }
    }
    echo '<link href="' . Helper::options()->themeUrl . '/assets/css/setting.css" rel="stylesheet" type="text/css" />';
    echo <<<EOF
<div class="theme-setting-contain">
    <div class="theme-setting-left-aside">
        <ul class="theme-setting-tab">
            <li data-current="theme-setting-notice">最新公告</li>
            <li data-current="theme-setting-global">全局设置</li>
            <li data-current="theme-setting-basic">基本信息</li>
            <li data-current="theme-setting-index">首页设置</li>
            <li data-current="theme-setting-post">文章设置</li>
            <li data-current="theme-setting-aside">侧边栏设置</li>
            <li data-current="theme-setting-development">开发者设置</li>
            <li data-current="theme-setting-couple">情侣功能</li>
        </ul>
    </div>
    <span id="theme-version" style="display: none;">$version</span>
    <div class="theme-setting-notice">请求数据中...</div>
EOF;
    echo '<script src="' . Helper::options()->themeUrl . '/assets/js/setting.js"></script>';

    // 全局设置

    $darkBtn = new \Typecho\Widget\Helper\Form\Element\Radio('darkBtn',[1=>'启用',0=>'禁用'], 1, '暗黑模式');
    $darkBtn->setAttribute('class', 'theme-setting-content theme-setting-global');
    $form->addInput($darkBtn);

    $notice = new \Typecho\Widget\Helper\Form\Element\Text('notice', NULL, NULL, '公告');
    $notice->setAttribute('class', 'theme-setting-content theme-setting-index');
    $form->addInput($notice);

    $bannerBtn = new \Typecho\Widget\Helper\Form\Element\Radio('bannerBtn', [1=>'启用',0=>'禁用'], 1, '幻灯片');
    $bannerBtn->setAttribute('class', 'theme-setting-content theme-setting-index');
    $form->addInput($bannerBtn);

    $bannerUrl = new \Typecho\Widget\Helper\Form\Element\Textarea('bannerUrl', NULL, NULL, '幻灯片内容', '一行一个链接,大于3行将随机<br>例如：<br>https://dyedd.cn/usr/uploads/2020/08/4115250106.png|https://dyedd.cn/806.html|lanstar主题下载|你的下一代主题|#000|#fff|3|1.5|');
    $bannerUrl->setAttribute('class', 'theme-setting-content theme-setting-index');
    $form->addInput($bannerUrl);

    $customNavIcon = new \Typecho\Widget\Helper\Form\Element\Textarea('customNavIcon', NULL, NULL, '自定义导航小图标', '按照格式书写，自定义内导航栏右侧的小图标，留空则展示默认的图标按钮，书写的格式请查看 wiki');
    $customNavIcon->setAttribute('class', 'theme-setting-content theme-setting-global');
    $form->addInput($customNavIcon);

    $compressHtml = new \Typecho\Widget\Helper\Form\Element\Radio('compressHtml', [1=>'启用',0=>'禁用'], 0, 'HTML压缩', '对HTML代码进行压缩，可能与部分插件存在兼容问题，请酌情开启');
    $compressHtml->setAttribute('class', 'theme-setting-content theme-setting-global');
    $form->addInput($compressHtml);

    $LoadingOptions = [
        'block' => "交错方块",
        'custom' => "自定义"
    ];
    $LoadingImage = new \Typecho\Widget\Helper\Form\Element\Select('loading_image', $LoadingOptions, 'block', '图片懒加载动画', "选择懒加载动画的图片，若选择自定义，则需要在 images/loading 目录下添加名为 custom.gif 的文件");
    $LoadingImage->setAttribute('class', 'theme-setting-content theme-setting-global');
    $form->addInput($LoadingImage);

    // 基本信息

    $asideAvatar = new \Typecho\Widget\Helper\Form\Element\Text('asideAvatar', NULL, NULL, '站点图标/个人头像');
    $asideAvatar->setAttribute('class', 'theme-setting-content theme-setting-basic');
    $form->addInput($asideAvatar);

    $asideName = new \Typecho\Widget\Helper\Form\Element\Text('asideName', NULL, NULL, '站点标题/个人昵称');
    $asideName->setAttribute('class', 'theme-setting-content theme-setting-basic');
    $form->addInput($asideName);
    
    $asideMotto = new \Typecho\Widget\Helper\Form\Element\Text('asideMotto', NULL, NULL, '站点副标题/个人格言');
    $asideMotto->setAttribute('class', 'theme-setting-content theme-setting-basic');
    $form->addInput($asideMotto);

    $asideStatus = new \Typecho\Widget\Helper\Form\Element\Text('asideStatus', NULL, NULL, '状态emoji');
    $asideStatus->setAttribute('class', 'theme-setting-content theme-setting-basic');
    $form->addInput($asideStatus);

    $recordNo = new \Typecho\Widget\Helper\Form\Element\Text('recordNo', NULL, NULL, 'ICP网站备案号');
    $recordNo->setAttribute('class', 'theme-setting-content theme-setting-basic');
    $form->addInput($recordNo);

    $footerName = new \Typecho\Widget\Helper\Form\Element\Text('footerName', NULL, NULL, '版权主体', '页脚版权主体信息，默认为站点名称');
    $footerName->setAttribute('class', 'theme-setting-content theme-setting-basic');
    $form->addInput($footerName);

    $setupDate = new \Typecho\Widget\Helper\Form\Element\Text('setupDate', NULL, NULL, '建站日期 (YYYY-MM-DD)');
    $setupDate->setAttribute('class', 'theme-setting-content theme-setting-basic');
    $form->addInput($setupDate);

    $setupDateStr = new \Typecho\Widget\Helper\Form\Element\Text('setupDateStr', NULL, NULL, '建站时长说明文本');
    $setupDateStr->setAttribute('class', 'theme-setting-content theme-setting-basic');
    $form->addInput($setupDateStr);

    // 文章

    $jsPushBaidu = new \Typecho\Widget\Helper\Form\Element\Radio('jsPushBaidu', [1=>'启用',0=>'禁用'], 0, '自动推送', '使用通用js自动推荐给百度引擎，增快收录');
    $jsPushBaidu->setAttribute('class', 'theme-setting-content theme-setting-post');
    $form->addInput($jsPushBaidu);

    $LicenseInfo = new \Typecho\Widget\Helper\Form\Element\Text('LicenseInfo', NULL, NULL, '文章许可信息', '填入后将在文章底部显示你填入的许可信息（支持HTML标签），留空则默认为 (CC BY-SA 4.0)国际许可协议。');
    $LicenseInfo->setAttribute('class', 'theme-setting-content theme-setting-post');
    $form->addInput($LicenseInfo);

    // 侧边栏
    // $sidebarBlocks = [
    //     'ShowBlogInfo' => '显示博主信息',
    //     'ShowRecentComments' => '显示最近评论',
    //     'ShowInterestPosts' => '显示可能感觉兴趣的文章'
    // ];
    // $sidebarBlock = new \Typecho\Widget\Helper\Form\Element\Checkbox('sidebarBlock',$sidebarBlocks,array_keys($sidebarBlocks), '<h2>侧边栏功能</h2>', '在这里选择需要展示在右侧侧边栏的内容');
    // $sidebarBlock->setAttribute('class', 'theme-setting-content theme-setting-aside');
    // $form->addInput($sidebarBlock->multiMode());

    $ShowBlogInfo = new \Typecho\Widget\Helper\Form\Element\Radio('ShowBlogInfo',[1=>'启用',0=>'禁用'],1, '博客信息', '显示博客统计数据信息<br>（文章、评论、分类、页面；媒体信息；建站时长）');
    $ShowBlogInfo->setAttribute('class', 'theme-setting-content theme-setting-aside');
    $form->addInput($ShowBlogInfo);
    
    $ShowRecentComments = new \Typecho\Widget\Helper\Form\Element\Radio('ShowRecentComments',[1=>'启用',0=>'禁用'],1, '最近评论', '显示最近评论');
    $ShowRecentComments->setAttribute('class', 'theme-setting-content theme-setting-aside');
    $form->addInput($ShowRecentComments);
    
    $ShowInterestPosts = new \Typecho\Widget\Helper\Form\Element\Radio('ShowInterestPosts',[1=>'启用',0=>'禁用'],1, '感兴趣的文章', '显示可能感兴趣的文章');
    $ShowInterestPosts->setAttribute('class', 'theme-setting-content theme-setting-aside');
    $form->addInput($ShowInterestPosts);

    $rightIcon = new \Typecho\Widget\Helper\Form\Element\Textarea('rightIcon', NULL, NULL, '媒体信息', '名称+图标类+地址，一行一个<br>例如：GitHub+fa-brands fa-github+https://github.com/');
    $rightIcon->setAttribute('class', 'theme-setting-content theme-setting-aside');
    $form->addInput($rightIcon);

    $extraIcon = new \Typecho\Widget\Helper\Form\Element\Text('extraIcon', NULL, NULL, '媒体额外引用', '当主题自带的icon不满足你的时候，可以在这里添加iconfont的js链接，增加网站图标');
    $extraIcon->setAttribute('class', 'theme-setting-content theme-setting-aside');
    $form->addInput($extraIcon);

    // 开发者设置

    $footerEcho = new \Typecho\Widget\Helper\Form\Element\Textarea('footerEcho', NULL, NULL, '自定义页脚信息', '填写 html 代码，将输出在 &lt;footer&gt; 标签中，可以在这里写上统计代码');
    $footerEcho->setAttribute('class', 'theme-setting-content theme-setting-development');
    $form->addInput($footerEcho);

    $headerEcho = new \Typecho\Widget\Helper\Form\Element\Textarea('headerEcho', NULL, NULL, '自定义头部信息', '填写 html 代码，将输出在 &lt;head&gt; 标签中，可以在这里写上统计代码');
    $headerEcho->setAttribute('class', 'theme-setting-content theme-setting-development');
    $form->addInput($headerEcho);

    $cssEcho = new \Typecho\Widget\Helper\Form\Element\Textarea('cssEcho', NULL, NULL, '自定义 CSS 样式', '填写 CSS 代码，输出在 &lt;head&gt; 标签结束之前的 &lt;style&gt; 标签内');
    $cssEcho->setAttribute('class', 'theme-setting-content theme-setting-development');
    $form->addInput($cssEcho);

    $jsEcho = new \Typecho\Widget\Helper\Form\Element\Textarea('jsEcho', NULL, NULL, '自定义 JavaScript', '填写 JavaScript代码，输出在 &lt;body&gt; 标签结束之前');
    $jsEcho->setAttribute('class', 'theme-setting-content theme-setting-development');
    $form->addInput($jsEcho);

    // 情侣功能

    $coupleFunction = new \Typecho\Widget\Helper\Form\Element\Radio('coupleFunction',[1=>'启用',0=>'禁用'],1, '情侣功能', '启用情侣功能，在右侧边栏显示');
    $coupleFunction->setAttribute('class', 'theme-setting-content theme-setting-couple');
    $form->addInput($coupleFunction);

    $coupleAvatar1 = new \Typecho\Widget\Helper\Form\Element\Text('coupleAvatar1', NULL, NULL, '头像(左)');
    $coupleAvatar1->setAttribute('class', 'theme-setting-content theme-setting-couple');
    $form->addInput($coupleAvatar1);

    $coupleName1 = new \Typecho\Widget\Helper\Form\Element\Text('coupleName1', NULL, NULL, '名称(左)');
    $coupleName1->setAttribute('class', 'theme-setting-content theme-setting-couple');
    $form->addInput($coupleName1);

    $coupleAvatar2 = new \Typecho\Widget\Helper\Form\Element\Text('coupleAvatar2', NULL, NULL, '头像(右)');
    $coupleAvatar2->setAttribute('class', 'theme-setting-content theme-setting-couple');
    $form->addInput($coupleAvatar2);

    $coupleName2 = new \Typecho\Widget\Helper\Form\Element\Text('coupleName2', NULL, NULL, '名称(右)');
    $coupleName2->setAttribute('class', 'theme-setting-content theme-setting-couple');
    $form->addInput($coupleName2);

    $committedDate = new \Typecho\Widget\Helper\Form\Element\Text('committedDate', NULL, NULL, '结缘日期 (YYYY-MM-DD)');
    $committedDate->setAttribute('class', 'theme-setting-content theme-setting-couple');
    $form->addInput($committedDate);

    $committedDateStr = new \Typecho\Widget\Helper\Form\Element\Text('committedDateStr', NULL, NULL, '交往时长说明文本');
    $committedDateStr->setAttribute('class', 'theme-setting-content theme-setting-couple');
    $form->addInput($committedDateStr);

}
