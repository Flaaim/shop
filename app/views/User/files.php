<?php

use Wfm\View;

?>


<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><?= __('tpl_user_cabinet_sidebar_files'); ?></li>
        </ol>
    </nav>
</div>

<div class="container py-3">
    <div class="col-lg-12 category-content">
        <h1 class="section-title"><?= __('tpl_user_cabinet_sidebar_files'); ?></h1>
    </div>
    <div class="row">
        <div class="col-3">
            <?php $this->getPart('/cabinet_sidebar'); ?>
        </div>
        <div class="col-9">
            <?php if($files): ?>
                <table class="table">
                    <th><?= __('tpl_files_number_order') ?></th>
                    <th><?= __('tpl_files_file') ?></th>
                    <th><?= __('tpl_files_download') ?></th>
                    <?php foreach($files as $item): ?>
                        <tr>
                            <td><?= $item['order_id'] ?></td>
                            <td><?= $item['name'] ?></td>
                            <td><a href="user/download?id=<?= $item['download_id'] ?>"><i class="fas fa-download"></i></a></td>
                        </tr>
                    <?php endforeach ?>
                </table>
            <?php endif ?>
        </div>
    </div>
</div>