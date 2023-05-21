<?php

use Wfm\View;

?>


<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><?= __('tpl_user_cabinet_sidebar_orders'); ?></li>
            <li class="breadcrumb-item"><?= __('tpl_view_order_title'); ?></li>
        </ol>
    </nav>
</div>
<div class="container py-3">
    <div class="col-lg-12 category-content">
            <h1 class="section-title"><?= __('tpl_view_order_title') ?></h1>
    </div>
    <div class="row">
        <div class="col-3">
            <?php $this->getPart('/cabinet_sidebar'); ?>
        </div>
        <div class="col-9">
            <?php if($order): ?>
                <table class="table">
                    <th><?= __('tpl_view_order_name') ?></th>
                    <th><?= __('tpl_view_order_price') ?></th>
                    <th><?= __('tpl_view_order_qty') ?></th>
                    <th><?= __('tpl_view_order_sum') ?></th>
                    <?php foreach($order as $item): ?>
                        <tr>
                            <td><?= $item['title'] ?></td>
                            <td><?= $item['price'] ?></td>
                            <td><?= $item['qty'] ?></td>
                            <td><?= $item['sum'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </table>
                
                <h2><?= __('tpl_view_order_detail_order') ?></h2>
                <table class="table">
                    <tr>
                        <td><?= __('tpl_view_order_number_order') ?></td>
                        <td><?= $order[0]['order_id'] ?></td>
                    </tr>
                    <tr>
                        <td><?= __('tpl_view_order_status_order') ?></td>
                        <td><?php $order[0]['status'] ? '' : __('tpl_view_order_status_new') ?></td>
                    </tr>
                    <tr>
                        <td><?= __('tpl_view_order_created_at_order') ?></td>
                        <td><?= $order[0]['created_at'] ?></td>
                    </tr>
                    <tr>
                        <td><?= __('tpl_view_order_updated_at_order') ?></td>
                        <td><?= $order[0]['updated_at'] ?></td>
                    </tr>
                    <tr>
                        <td><?= __('tpl_view_order_total_order') ?></td>
                        <td><?= $order[0]['total'] ?></td>
                    </tr>
                </table>
            
            <?php else: ?>
                <?= __('tpl_view_order_not_found') ?>
            <?php endif ?>
        </div>
    </div>
</div>