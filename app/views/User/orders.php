<?php

use Wfm\View;

?>


<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><?= __('tpl_user_cabinet_sidebar_orders'); ?></li>
        </ol>
    </nav>
</div>
<div class="container py-3">
    <div class="col-lg-12 category-content">
        <h1 class="section-title"><?= __('tpl_user_cabinet_sidebar_orders'); ?></h1>

    </div>
    <div class="row">
        <div class="col-3">
            <?php $this->getPart('/cabinet_sidebar'); ?>
        </div>
        <div class="col-9">
            <?php if(!empty($orders)): ?>
                <table class="table">
                    <th><?= __('tpl_cabinet_orders_id') ?></th>
                    <th><?= __('tpl_cabinet_orders_status') ?></th>
                    <th><?= __('tpl_cabinet_orders_total_price') ?></th>
                    <th><?= __('tpl_cabinet_orders_created_at') ?></th>
                    <th><?= __('tpl_cabinet_orders_updated_at') ?></th>
                    <th><i class="fas fa-edit"></i></th>
                <?php foreach($orders as $order): ?>
                    <tr>
                        <td><?= $order['id']?></td>
                        <td><?php if($order['status'] == "0") echo __('tpl_cabinet_orders_status_name');?></td>
                        <td><?= "$".$order['total']?></td>
                        <td><?= $order['created_at']?></td>
                        <td><?= $order['updated_at']?></td>
                        <td><a href="user/order?id=<?= $order['id'] ?>"><i class="fas fa-edit"></i></a></td>
                    </tr>
                <?php endforeach ?>
                </table>
                <?php else: ?>
                <p>Заказы не найдены!</p>
            <?php endif ?>
        </div>
    </div>
</div>