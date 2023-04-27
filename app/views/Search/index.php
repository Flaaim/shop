<?php

use Wfm\View;

?>

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><?= __('tpl_search_title') ?></li>
        </ol>
    </nav>
</div>
<div class="container py-3">
<div class="col-lg-12 category-content">
    <h1 class="section-title"><?= __('tpl_search_title') ?></h1>

    <h4><?= __('tpl_search_description'). $s ?></h4>
</div>

    <div class="row">
        <?php if($products): ?>
        <?= $this->getPart('productsloop', compact('products')); ?>
        <p><?= "Показано ".count($products)." из $total" ?></p>
        <div class="row">
            <div class="col-md-12">
                <?= $pagination ?>
            </div>
        </div>
       
        <?php else: ?>
        <?= "Products not found..."; ?>
        <?php endif ?>

    </div>
</div>