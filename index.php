<?php
/**
 * 自制简单主题，你的star就是我的动力
 *
 * @package Lanstar
 * @author 染念
 * @version 2.2.5
 * @link https://dyedd.cn
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('layout/header.php');
?>
<div class="container">
    <div class="row">
        <?php $this->need('layout/left.php'); ?>
        <div class="col-xl-6 col-md-6 col-12" id="pjax-container">
            <header class="toolbar">
                <div class="toolbar-left">主页</div>
                <div class="toolbar-right">
                    <button class="float-end d-block d-md-none mobile-nav" type="button">
                        <svg class="icon" aria-hidden="true">
                            <use xlink:href="#icon-daohang1"></use>
                        </svg>
                    </button>
                    <button class="float-end chose-mode-day float-right" id="night-mode" type="button">
                        <svg class="icon" aria-hidden="true">
                            <use xlink:href="#icon-yueliang"></use>
                        </svg>
                    </button>
                    <button class="float-end chose-mode-moon float-right" id="night-mode" type="button">
                        <svg class="icon" aria-hidden="true">
                            <use xlink:href="#icon-taiyang"></use>
                        </svg>
                    </button>
                </div>
            </header>
            <?php $this->need('component/index.banner.php') ?>
            <?php $this->need('component/index.article.php'); ?>
            <div class="page-pagination">
                <?php
                $this->pageNav(
                    '<svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-zuo"></use>
                    </svg>',
                    '<svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-you"></use>
                    </svg>',
                    3, '...', array(
                    'wrapTag' => 'ul',
                    'wrapClass' => 'pagination justify-content-center',
                    'itemTag' => 'li',
                    'itemClass' => 'page-item',
                    'linkClass' => 'page-link',
                    'currentClass' => 'active'
                ));
                ?>
            </div>
        </div>
        <?php $this->need('layout/right.php'); ?>
    </div>
</div>
<?php $this->need('component/index.footer.php'); ?>
</body>
</html>
