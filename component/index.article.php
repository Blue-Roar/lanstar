<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<?php while ($this->next()): ?>
    <div class="article-list">
        <div class="content">
            <div class="created">
                <time datetime="<?php $this->date(); ?>"><?=  date('n月j日，Y', $this->created) ?></time>
            </div>
            <div class="categories-avatar">
                <?php $categories = $this->categories;?>
                <img class="avatar"
                     src="<?=  $categories[0]['description']; ?>"
                     alt="<?=  $categories[0]['name']; ?>"
                     data-bs-toggle="tooltip" data-bs-placement="bottom"
                     data-bs-title="<?=  $categories[0]['name']; ?>"/>
            </div>
            <?php if ($this->fields->article_type != 3): ?>
                <div class="article-name">
                    <a title="<?php $this->title(); ?>" href="<?php $this->permalink(); ?>"><?php $this->title(); ?></a>
                </div>
            <?php endif; ?>
            <?php if ($this->fields->article_type == 0): ?>
                <div class="markdown-body describe">
                    <?=  utils::get_summary($this->content,2);?>
                </div>
            <?php elseif ($this->fields->article_type == 1): ?>
                <div class="markdown-body describe pic">
                    <div class="img">
                        <?php if ($this->fields->banner && $this->fields->banner != ''): ?>
                            <img src="<?php $this->fields->banner(); ?>" alt="cover">
                        <?php else: ?>
                            <img src="<?php utils::indexTheme('assets/img/default.jpg')?>" alt="cover">
                        <?php endif; ?>
                    </div>
                </div>
            <?php elseif ($this->fields->article_type == 2 || $this->fields->article_type == 4): ?>
                <div class="describe gallery" view-image>
                    <?=  utils::get_summary($this->content,4,1);?>
                </div>
            <?php elseif ($this->fields->article_type == 3): ?>
                <div class="markdown-body describe text">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-yinyong"></use>
                    </svg>
                    <?=  utils::get_summary($this->content,3);?>
                </div>
            <?php endif; ?>
        </div>
        <?php if ($this->fields->article_type != 3 && $this->fields->article_type != 4): ?>
            <div class="related">
                <?php if ($this->hidden):?>
                    <a class="more" target="_blank" title="新窗口查看" href="<?php $this->permalink(); ?>">查看更多</a>
                <?php else:?>
                    <a class="more" title="查看更多" href="<?php $this->permalink(); ?>">查看更多</a>
                <?php endif;?>
                <div class="extra">
                    <div class="view">
                        <span class="fa-solid fa-eye fa-fw"></span>
                        <?php utils::getPostView($this); ?>
                    </div>
                    <div class="commentNum">
                        <span class="fa-solid fa-comments fa-fw"></span>
                        <?php $this->commentsNum('0', '1', '%d'); ?>
                    </div>
                    <div class="articleCount">
                        <span class="fa-solid fa-chart-bar fa-fw"></span>
                        <?php utils::artCount($this->cid); ?>
                    </div>
                    <div class="like" data-cid="<?php $this->cid(); ?>"
                         data-bs-toggle="tooltip" data-bs-placement="right"
                         data-bs-title="喜欢">
                        <?php $agree = $this->hidden ? array('agree' => 0, 'recording' => true) : utils::agreeNum($this->cid); ?>
                        <span class="fa-solid fa-heart fa-fw"></span>
                        <b class="agree-num"><?=  $agree['agree']; ?></b>
                    </div>
                </div>
            </div>
            <?php $comments = utils::get_comment_by_cid($this->cid) ?>
            <?php if ($comments): ?>
                <div class="index-comments">
                    <?php foreach ($comments as $comment): ?>
                        <?php if ($comment['status'] =='approved'): ?>
                        <div class="index-comments-list">
                            <img src="<?php utils::emailHandle($comment['mail']) ?>s=100"
                                 alt="<?=  $comment['author'] ?>">
                            <span class="author"><?=  $comment['author'] ?>
                                <?php if ($comment['authorId'] == $comment['ownerId']): ?>
                                    <span class="badge rounded-pill bg-primary comment-author-title">作者</span>
                                <?php endif; ?></span>
                            <?php $text = preg_replace("/(?s)\[secret\]([^\]]*?)\[\/secret\]/", '此处隐藏',
                                $comment['text']) ?>
                            <span class="text"><?=  preg_replace("/<br>|<p>|<\/p>/", ' ',
                                    $text) ?></span>
                            <span class="created"><?=  date('n月j日', $comment['created']) ?></span>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php endwhile; ?>
