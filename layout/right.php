<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<br class="d-md-none">
<button type="button" class="btn-close float-end d-md-none" id="mobile-tool" aria-label="Close"></button>
<br class="d-md-none">
<div class="search-bar">
    <form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
        <input type="text" id="s" name="s" class="nav-search-input" placeholder="<?php _e('输入关键字搜索'); ?>">
        <button class="nav-search-btn" type="submit"><span class="fa-2x fa-solid fa-search" style="vertical-align: middle;"></span></button>
    </form>
</div>
<?php if ($this->options->coupleFunction): ?>
    <div class="sidebar-box">
        <div class="couple">
            <img class="pic" src="<?php $this->options->coupleAvatar1(); ?>">
            <span class="couple-love fa-2x fa-solid fa-heart fa-beat"></span>
            <img class="pic" src="<?php $this->options->coupleAvatar2(); ?>">
        </div>
        <div class="time-text"><?php $this->options->committedDateStr(); ?><?=utils::calcDuration($this->options->committedDate)?></div>
    </div>
<?php endif; ?>
<?php if ($this->options->ShowBlogInfo): ?>
    <div class="sidebar-box">
        <?php Typecho_Widget::widget('Widget_Stat')->to($item); ?>
        <div class="count">
            <div class="item" title="累计文章数">
                <span class="num"><?=  number_format($item->publishedPostsNum); ?></span>
                <span>文章数</span>
            </div>
            <div class="item" title="累计评论数">
                <span class="num"><?=  number_format($item->publishedCommentsNum); ?></span>
                <span>评论量</span>
            </div>
            <div class="item" title="累计分类数">
                <span class="num"><?=  number_format($item->categoriesNum); ?></span>
                <span>分类数</span>
            </div>
            <div class="item" title="累计页面数">
                <span class="num"><?=  number_format($item->publishedPagesNum + $item->publishedPostsNum); ?></span>
                <span>页面数</span>
            </div>
        </div>
        <div class="card-icon">
            <a href="<?php $this->options->siteUrl(); ?>feed" title="rss" target="_blank"><span class="fa-2x fa-solid fa-rss"></span></a>
            <?=  utils::handleRightIcon() ?>
        </div>
        <div class="time-text"><?php $this->options->setupDateStr(); ?><?=utils::calcDuration($this->options->setupDate)?></span></div>
    </div>
<?php endif; ?>
<?php if ($this->is('post')): ?>
<?php $this->need('component/post.catalog.php'); ?>
<?php endif; ?>
<?php if ($this->options->ShowRecentComments): ?>
    <?php if ($this->is('index')): ?>
        <div class="sidebar-box">
            <div class="p-3"><h6>最近消息</h6></div>
            <div class="sidebar-content px-4">
                <?php $this->widget('Widget_Comments_Recent', 'ignoreAuthor=true&pageSize=5')->to($comments); ?>
                <?php while ($comments->next()): ?>
                    <div class="sidebar-reply mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="card-body">
                                <div class="card-title">
                                    <img class="rounded-circle sidebar-reply-img" src="<?php utils::emailHandle($comments->mail); ?>s=100"/>
                                    <span class="author"><?php $comments->author(false); ?></span>
                                    <span class="date text-muted"><?=date('Y-m-d', $comments->created); ?></span>
                                </div>
                                <p class="card-text">
                                    <a class="sidebar-reply-content" href="<?php $comments->permalink(); ?>" target="_blank">
                                        <?php contents::parseHide($comments->excerpt(35, '...')); ?>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php if ($this->options->ShowInterestPosts): ?>
    <div class="sidebar-box">
        <div class="p-3"><h6>可能感兴趣</h6></div>
        <div class="sidebar-content px-3 pb-2">
            <?php utils::getRandomPosts(3); ?>
        </div>
    </div>
<?php endif; ?>
<?php $this->need('layout/footer.php'); ?>

