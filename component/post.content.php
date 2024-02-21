<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<section class="article-info">
        <div class="article-cover-inner">
            <img src="<?= $this->fields->banner?: utils::indexTheme('assets/img/default.jpg') ?>" alt="cover">
            <h1 class="article-title">
                <?php if ($this->user->hasLogin()): ?>
                    <a class="article-edit" title="编辑"
                       href="<?php $this->options->adminUrl(); ?>write-post.php?cid=<?= $this->cid; ?>">
                        <span><?php $this->title(); ?></span>
                    </a>
                <?php else: ?>
                    <span><?php $this->title(); ?></span>
                <?php endif; ?>
            </h1>
        </div>
        <div class="article-detail">
                <div class="post-info">
                    <div class="post-info-icon">
                        <span class="fa-solid fa-fire fa-fw"></span>
                        <?php utils::getPostView($this); ?>阅读
                    </div>
                    <div class="post-info-icon">
                        <span class="fa-solid fa-comments fa-fw"></span>
                        <?php $this->commentsNum(); ?>条评论
                    </div>
                    <div class="post-info-icon">
                        <span class="fa-solid fa-calendar-days fa-fw"></span>
                        <time datetime="<?php $this->date('c'); ?>">
                            <?php $this->date(); ?></time>
                    </div>
                </div>
        </div>
</section>
<main class="article-main">
    <!--文章内容-->
    <div class="markdown-body article-content gallery">
        <?php if ($this->hidden || $this->titleshow): ?>
            <form action="<?= Typecho_Widget::widget('Widget_Security')->getTokenUrl($this->permalink); ?>"
                  class="protected">
                <div class="form-group mb-3 col-md-12 text-center">
                    <label for="passwd">请输入密码访问</label>
                    <div class="input-group">
                        <input type="password" id="passwd" name="protectPassword" class="form-control text"
                               placeholder="请输入密码" aria-label="请输入密码">
                        <input type="hidden" name="protectCID" value="<?php $this->cid(); ?>"/>
                        <div class="input-group-append">
                            <button class="btn btn-primary protected-btn" type="button">提交</button>
                        </div>
                    </div>
                </div>
            </form>
        <?php else: ?>
            <?php $this->content(); ?>
        <?php endif; ?>
    </div>
    <p class="tags"><?php $this->tags(' ', true, ''); ?></p>
    <div class="license">
        <div class="content">
            <div class="item">
                <span class="fa-solid fa-at fa-fw"></span>
                <span>本文作者为 <?php $this->author(); ?></span>
            </div>
            <div class="item">
                <span class="fa-brands fa-creative-commons fa-fw"></span>
                <span><?= $this->options->LicenseInfo ? $this->options->LicenseInfo : '本作品采用 <a rel="license nofollow" href="https://creativecommons.org/licenses/by-sa/4.0/" target="_blank">知识共享署名-相同方式共享 4.0 国际许可协议</a> 进行许可。' ?></span>
            </div>
            <div class="item">
                <span class="fa-solid fa-link fa-fw"></span>
                <span><a class="item-link" href="<?php $this->permalink(); ?>" title="转载时请注明本文出处及文章链接"><?php $this->permalink(); ?></a></span>
            </div>
        </div>
    </div>
    <div class="other">
        <div class="modified">
            更新于 <?= date('Y年m月d日 H:i', $this->modified) ?>
        </div>
    </div>
    <div class="article-action">
        <div class="article-action-item">
            <a id="comment" href="#comment" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="评论">
                <span class="fa-2x fa-solid fa-comment-dots fa-fw"></span>
            </a>
        </div>
        <div class="article-action-item" id="agree-btn" data-cid="<?php $this->cid(); ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="点赞">
            <span class="fa-2x fa-solid fa-heart fa-fw"></span>
            <?php $agree = $this->hidden ? array('agree' => 0, 'recording' => true) : utils::agreeNum($this->cid); ?>
            <span class="agree-num"><?= $agree['agree']; ?></span>
        </div>
        <div class="article-action-item">
            <span class="fa-2x fa-solid fa-link fa-fw" data-bs-toggle="dropdown" aria-expanded="false"></span>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item js-pjax" target="_blank"
                       href="https://connect.qq.com/widget/shareqq/index.html?url=<?php
                       $this->permalink ?>&sharesource=qzone&title=<?php $this->title ?>&pics=<?= $this->fields->banner ? $this->fields->banner() : utils::indexTheme('assets/img/default.jpg') ?>&summary=<?php $this->excerpt(100) ?>"><span class="fa-brands fa-qq fa-fw"></span> 分享到QQ</a>
                </li>
                <li><a class="dropdown-item js-pjax"
                       href="https://service.weibo.com/share/share.php?url=<?php $this->permalink(); ?>&title=<?php $this->title(); ?>"
                       target="_blank"><span class="fa-brands fa-weibo fa-fw"></span> 分享到微博</a></li>
                <li><a class="dropdown-item js-pjax"
                       href="https://twitter.com/intent/tweet?url=<?php $this->permalink(); ?>&text=<?php $this->title(); ?>"
                       target="_blank"><span class="fa-brands fa-twitter fa-fw"></span> 分享到Twitter</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item js-pjax url-copy" href="javaScript:void(0)">复制链接</a></li>
            </ul>
        </div>
    </div>
    <div class="article-page">
        <div class="article-page-item prev">
            <?php thePrev($this); ?>
        </div>
        <div class="article-page-item next">
            <?php theNext($this); ?>
        </div>
    </div>
    <?php $this->need('layout/comments.php'); ?>
</main>
