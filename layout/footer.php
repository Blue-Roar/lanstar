<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<footer class="container footer">
    <p class="footer-item">
        &copy; <?=($this->options->setupDate)?(date("Y",strtotime($this->options->setupDate)).'~'):('')?><?=date('Y')?>
        <strong><a href="<?=$this->options->siteUrl?>"><?=$this->options->footerName?$this->options->footerName:$this->options->title?></a></strong>
        <?=($this->options->recordNo) ? '(<a class="footer-item" target="_blank" href="https://beian.miit.gov.cn/">'.$this->options->recordNo.'</a>)' : ''?>
    </p>
    <p>
        <?php $this->options->footerEcho();?>
    </p>
    <p class="footer-item">由 <a href="https://typecho.org/" target="_blank">Typecho</a> + <a href="https://dyedd.cn/" title="禁止仿制" target="_blank">Lanstar</a> 主题强力驱动</p>
</footer>
<?php $this->footer(); ?>
<div class="tools">
    <?php if ($this->options->darkBtn): ?>
        <div class="chose-mode-day" id="night-mode" type="button">
            <span class="fa-3x fa-solid fa-sun fa-fw"></span>
            <p>暗黑模式</p>
        </div>
        <div class="chose-mode-moon" id="night-mode" type="button">
            <span class="fa-3x fa-solid fa-moon fa-fw"></span>
            <p>暗黑模式</p>
        </div>
    <?php endif; ?>
    <?php if($this->is('post')): ?>
        <div onclick="location.href='#comment'">
            <span class="fa-3x fa-solid fa-comment-dots fa-fw"></span>
            <p>评论</p>
        </div>
    <?php endif; ?>
    <div class="back-to-top" onclick="app.addBackTop()">
        <span class="fa-3x fa-solid fa-chevron-up fa-fw"></span>
        <p>返回顶部</p>
    </div>
</div>
