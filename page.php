<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('layout/header.php'); ?>
<div class="container">
    <div class="row">
        <div class="col col-md-2 d-none d-md-block mobile-nav">
            <?php $this->need('layout/left.php'); ?>
        </div>
        <div class="col-xl-10 col-md-10">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-md-8 col-12 main">
                        <?php $this->need('component/index.toolbar.php'); ?>
                        <?php $this->need('component/page.content.php') ?>
                    </div>
                    <div class="col-12 col-md-3 position-relative right d-none d-md-block">
                        <?php $this->need('layout/right.php'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 d-md-none">
            <?php $this->need('layout/footer.php'); ?>
        </div>
    </div>
</div>
<?php $this->need('component/index.footer.php'); ?>
</body>
</html>
