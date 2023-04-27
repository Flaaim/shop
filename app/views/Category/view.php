<?php

use Wfm\View;

?>

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <?= $breadcrumbs ?>
            
        </ol>
    </nav>
</div>
<div class="container py-3">
<div class="col-lg-12 category-content">
    <h3 class="section-title"><?= $category['title'] ?></h3>

    <p><?=  $category['content'] ?></p>

    <div class="row">
        <?php if($products && count($products) > 2): ?>
        <div class="col-sm-6">
            <div class="input-group mb-3">
                <label class="input-group-text" for="input-sort"><?= __('tpl_category_sort') ?></label>
                <select class="form-select" id="input-sort">
                    <option selected disabled><?= __('tpl_category_sort_selected') ?></option>
                    <option value="sort=title_asc" <?php if(isset($_GET['sort']) && $_GET['sort'] == 'title_asc') echo "selected"; ?>><?= __('tpl_category_sort_title_asc') ?></option>
                    <option value="sort=title_desc" <?php if(isset($_GET['sort']) && $_GET['sort'] == 'title_desc') echo "selected"; ?> ><?= __('tpl_category_sort_title_desc') ?></option>
                    <option value="sort=price_asc" <?php if(isset($_GET['sort']) && $_GET['sort'] == 'price_asc') echo "selected"; ?>><?= __('tpl_category_sort_price_low_to_high') ?></option>
                    <option value="sort=price_desc" <?php if(isset($_GET['sort']) && $_GET['sort'] == 'price_desc') echo "selected"; ?>><?= __('tpl_category_sort_price_high_to_low') ?></option>
                </select>
            </div>
        </div>
        <?php endif ?>

        <div class="col-sm-6">
            <div class="input-group mb-3">
                <label class="input-group-text" for="input-sort">Показать:</label>
                <select class="form-select" id="input-sort-count">
                    <option value="count=3" <?php if(isset($_GET['count']) && $_GET['count'] == 3) echo "selected" ?>>3</option>
                    <option value="count=5" <?php if(isset($_GET['count']) && $_GET['count'] == 5) echo "selected" ?>>5</option>
                    <option value="count=7" <?php if(isset($_GET['count']) && $_GET['count'] == 7) echo "selected" ?>>7</option>
                    <option value="count=10" <?php if(isset($_GET['count']) && $_GET['count'] == 10) echo "selected" ?>>10</option>
                    <option value="count=15" <?php if(isset($_GET['count']) && $_GET['count'] == 15) echo "selected" ?>>15</option>
                </select>
            </div>
        </div>
    </div>
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