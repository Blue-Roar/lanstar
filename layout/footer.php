<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<footer class="container footer">
    <p class="footer-item">
        &copy; <?=($this->options->startTime)?(date("Y",strtotime($this->options->startTime)).'~'):('')?><?=date('Y')?>
        <strong><a href="<?=$this->options->siteUrl?>"><?=$this->options->footerName?$this->options->footerName:$this->options->title?></a></strong>
        <?=($this->options->recordNo) ? '<a class="footer-item" target="_blank" href="https://beian.miit.gov.cn/">'.$this->options->recordNo.'</a>' : ''?>
    </p>
    <p>
        <?php $this->options->footerEcho();?>
    </p>
    <p class="footer-item">由 <a href="https://typecho.org/" target="_blank"><img style="height:2rem;filter:brightness(1);" src="https://typecho.org/usr/themes/bluecode/img/typecho-logo.svg" alt="typecho"></img></a> + <a href="https://dyedd.cn/" title="禁止仿制">Lanstar</a> 主题强力驱动</p>
</footer>
<?php $this->footer(); ?>
<div class="tools">
    <?php if ($this->options->darkBtn): ?>
        <div class="chose-mode-day" id="night-mode" type="button">
            <svg class="icon" aria-hidden="true">
                <use xlink:href="#icon-yueliang"></use>
            </svg><span>暗黑模式</span>
        </div>
        <div class="chose-mode-moon" id="night-mode" type="button">
            <svg class="icon" aria-hidden="true">
                <use xlink:href="#icon-taiyang"></use>
            </svg><span>暗黑模式</span>
        </div>
    <?php endif; ?>
    <?php if($this->is('post')): ?>
        <div onclick="location.href='#comment'">
            <svg class="icon" aria-hidden="true">
                <use xlink:href="#icon-pinglun2"></use>
            </svg><span>评论</span>
        </div>
    <?php endif; ?>
    <div class="back-to-top" onclick="app.addBackTop()">
        <svg class="icon" aria-hidden="true">
            <use xlink:href="#icon-fanhuidingbu-"></use>
        </svg><span>返回顶部</span>
    </div>
</div>
