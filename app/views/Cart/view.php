<?php

use Wfm\View;

?>

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="fas fa-home"></i></a></li>
            
        </ol>
    </nav>
</div>
<div class="container py-3">
<div class="col-lg-12 category-content">
    <h1 class="section-title"><?= __('tpl_cart_view_title') ?></h1>
</div>
<div class="row">
<?php if(!empty($_SESSION['cart'])): ?>
<div class="modal-body">
        <table class="table text-start">
            <thead>
                <tr>
                    <th scope="col"><?= __('tpl_cart_foto') ?></th>
                    <th scope="col"><?= __('tpl_cart_product') ?></th>
                    <th scope="col"><?= __('tpl_cart_qty') ?></th>
                    <th scope="col"><?= __('tpl_cart_price') ?></th>
                    <th scope="col"><i class="fas fa-trash"></i></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($_SESSION['cart'] as $id => $item): ?>
                <tr>
                    <td>
                        <a href="#"><img src="<?= PATH ?>/assets/img/products/<?= $item['img'] ?>" alt=""></a>
                    </td>
                    <td><a href="product/<?= $item['slug'] ?>"><?= $item['title'] ?></a></td>
                    <td><?= $item['qty'] ?></td>
                    <td>$<?= $item['price'] ?></td>
                    <td><a href="cart/delete?id=<?= $id ?>" data-id="<?= $id ?>" class="del-item"><i class="fas fa-trash"></i></a></td>
                </tr>
                <?php endforeach ?>
                <tr>
                    <td colspan="4"><?= __('tpl_cart_total') ?></td>
                    <td class="cart-qty-checkout"><?= $_SESSION['cart.qty'] ?></td>
                </tr>
                <tr>
                    <td colspan="4"><?= __('tpl_cart_total_price') ?></td>
                    <td class="cart-sum">$<?= $_SESSION['cart.sum'] ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php if(!empty($_SESSION['user'])): ?> 
        <div class="row">   
        <div class="d-flex justify-content-center">
                <div class="col-md-10">
                    <form action="cart/checkout" method="post">
                        <div class="form-group row my-3">
                            <label for="notation" class="col-md-2 col-form-label"><?= ___('tpl_cart_view_notation') ?></label>
                            <div class="col-md-8">
                            <textarea class="form-control" name="notation" placeholder="<?= ___('tpl_cart_view_notation') ?>" id="notation" rows="3"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger"><?= __('tpl_cart_view_checkout_order') ?></button>
                    </form>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="row">   
        <div class="d-flex justify-content-center">
                <div class="col-md-10">
                    <form action="cart/checkout" method="post">
                        <div class="form-group row my-3">
                            <label for="name" class="col-md-2 col-form-label"><?= ___('tpl_cart_view_name') ?></label>
                            <div class="col-md-8">
                            <input type="text" name="name" id="name" class="form-control" placeholder="<?= ___('tpl_cart_view_name') ?>">
                            </div>
                        </div>
                        <div class="form-group row my-3">
                            <label for="email" class="col-md-2 col-form-label"><?= ___('tpl_cart_view_email') ?></label>
                            <div class="col-md-8">
                            <input type="email" name="email" id="email" class="form-control" placeholder="<?= ___('tpl_cart_view_email') ?>">
                            </div>
                        </div>
                        <div class="form-group row my-3">
                        <label for="address" class="col-md-2 col-form-label"><?= __('tpl_cart_view_address') ?></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="address" id="address" placeholder="<?= __('tpl_cart_view_address') ?>">
                        </div>
                    </div>
                    <div class="form-group row my-3">
                        <label for="password" class="col-md-2 col-form-label"><?= __('tpl_cart_view_password') ?></label>
                        <div class="col-md-8">
                            <input type="password" class="form-control" name="password" id="password" placeholder="<?= __('tpl_cart_view_password') ?>">
                        </div>
                    </div>
                    <div class="form-group row my-3">
                        <label for="confirm_password" class="col-md-2 col-form-label"><?= __('tpl_cart_view_confirm_password') ?></label>
                        <div class="col-md-8">
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="<?= __('tpl_cart_view_confirm_password') ?>">
                        </div>
                    </div>
                    <div class="form-group row my-3">
                        <label for="notation" class="col-md-2 col-form-label"><?= ___('tpl_cart_view_notation') ?></label>
                        <div class="col-md-8">
                        <textarea class="form-control" name="notation" placeholder="<?= ___('tpl_cart_view_notation') ?>" id="notation" rows="3"></textarea>
                        </div>
                    </div>
                        <button type="submit" class="btn btn-danger"><?= __('tpl_cart_view_checkout_order') ?></button>
                    </form>
                </div>
            </div>
        </div>
    <?php endif ?>
<?php else: ?>
    <h4><?= __('tpl_cart_empty') ?><h4>
<?php endif ?>
</div>
</div>