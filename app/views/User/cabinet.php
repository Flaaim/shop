<?php

use Wfm\View;

?>


<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><?= __('tpl_cabinet') ?></li>
        </ol>
    </nav>
</div>
<div class="container py-3">
    <div class="col-lg-12 category-content">
        <h1 class="section-title"><?= __('tpl_cabinet') ?></h1>

    </div>
    <div class="row">
        <div class="col-3">
            <?php $this->getPart('/cabinet_sidebar'); ?>
        </div>
        <div class="col-9">

        </div>
    </div>
</div>