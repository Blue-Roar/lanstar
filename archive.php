<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('layout/header.php'); ?>
<div class="container">
    <div class="row">
        <div class="col col-lg-2 col-md-2 col-sm-2 col-xs-2 d-none d-lg-block left">
            <?php $this->need('layout/left.php'); ?>
        </div>
        <div class="col-lg-10 col-md-12 col-xs-10">
            <div class="container">
                <div class="row">
                    <div class="main">
                        <?php $this->need('component/index.toolbar.php'); ?>
                        <section class="article-info mb-3">
                            <div class="article-detail">
                                <h1 class="archive-title text-center p-3"><?php $this->archiveTitle(array(
                                        'category' => _t('分类 %s 下的文章'),
                                        'search' => _t('包含关键字 %s 的文章'),
                                        'tag' => _t('标签 %s 下的文章'),
                                        'author' => _t('%s 发布的文章')
                                    ), '', ''); ?></h1>
                            </div>
                            <div class="article-cover-inner">
                                <img src="<?= $this->fields->banner ?: utils::indexTheme('assets/img/default.jpg'); ?>"
                                     alt="cover">
                            </div>
                        </section>
                        <?php if ($this->have()): ?>
                            <?php $this->need('component/index.article.php'); ?>
                        <?php else: ?>
                            <article class="post">
                                <h2 class="post-title"><?php _e('没有找到内容'); ?></h2>
                            </article>
                        <?php endif; ?>

                        <?php
                            $this->pageNav(
                                '<span class="fa-3x fa-solid fa-chevron-left"></span>',
                                '<span class="fa-3x fa-solid fa-chevron-right"></span>',
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
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 right d-none d-lg-block">
                        <?php $this->need('layout/right.php'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 d-lg-none" style="text-align:center">
            <?php $this->need('layout/footer.php'); ?>
        </div>
    </div>
</div>
<?php $this->need('component/js.php'); ?>
</body>
</html>
