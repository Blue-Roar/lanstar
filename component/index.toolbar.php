<?php
/**
 * author:染念
 * time：2022-3-20 21：04
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<div class="fixed-body"></div>
<div class="toolbar">
    <div class="toolbar-left">
        <span class="header">
            <?php if ($this->is('index')): ?>
                <span class="fa-solid fa-home"></span> 首页
            <?php else: ?>
                <?php $this->need('component/breadcrumb.content.php'); ?>
            <?php endif; ?>
        </span>
        <div class="mobile-left">
            <span class="fa-2x fa-solid fa-bars"></span>
        </div>
    </div>
    <div class="toolbar-right">
        <div class="mobile-right">
            <?php if ($this->options->asideAvatar): ?>
                <img title="<?php $this->options->title(); ?>"
                     src="<?php $this->options->asideAvatar(); ?>" alt="logo">
            <?php else: ?>
                <img title="<?php $this->options->title(); ?>"
                     src="<?php utils::indexTheme('assets/img/logo.png'); ?>" alt="logo">
            <?php endif; ?>
        </div>
    </div>
</div>



