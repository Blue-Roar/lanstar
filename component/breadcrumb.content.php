<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!--面包屑导航-->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?php $this->options->siteUrl(); ?>">
                <span class="fa-solid fa-home fa-fw"></span>
                <span>首页</span>
            </a>
        </li>
        <?php if ($this->is('post')): ?>
            <li class="breadcrumb-item">
                <span><?php $this->category(','); ?></span>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <span><?php $this->archiveTitle('&raquo;', '', ''); ?></span>
            </li>
        <?php else: ?>
            <!-- <li class="breadcrumb-item active" aria-current="page">
                <span><?php $this->category(','); ?></span>
            </li> -->
            <li class="breadcrumb-item active" aria-current="page">
                <span><?php $this->archiveTitle('&raquo;', '', ''); ?></span>
            </li>
        <?php endif; ?>
    </ol>
</nav>
