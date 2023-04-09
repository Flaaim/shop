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
                    <td><a href="<?= $item['slug'] ?>"><?= $item['title'] ?></a></td>
                    <td><?= $item['qty'] ?></td>
                    <td>$<?= $item['price'] ?></td>
                    <td><a href="cart/delete?id=<?= $id ?>" data-id="<?= $id ?>" class="del-item"><i class="fas fa-trash"></i></a></td>
                </tr>
                <?php endforeach ?>
                <tr>
                    <td colspan="4"><?= __('tpl_cart_total') ?></td>
                    <td class="cart-qty"><?= $_SESSION['cart.qty'] ?></td>
                </tr>
                <tr>
                    <td colspan="4"><?= __('tpl_cart_total_price') ?></td>
                    <td class="cart-sum">$<?= $_SESSION['cart.sum'] ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger ripple" data-bs-dismiss="modal"><?= __('tpl_cart_continue') ?></button>
        <button type="button" id="clear-cart" class="btn btn-danger"><?= __('tpl_cart_clear') ?></button>
        <button type="button" class="btn btn-primary"><?= __('tpl_cart_checkout') ?></button>
    </div>
<?php else: ?>
    <h4><?= __('tpl_cart_empty') ?><h4>
<?php endif ?>