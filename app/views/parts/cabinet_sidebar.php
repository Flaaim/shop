<div class="list-group sidebar">
  <a href="user/cabinet" class="list-group-item list-group-item-action <?php getActiveLink('cabinet') ?>" aria-current="true">
    <?= __('tpl_user_cabinet_sidebar_cabinet'); ?>
  </a>
  <a href="user/orders" class="list-group-item list-group-item-action <?php getActiveLink('orders') ?>"><?= __('tpl_user_cabinet_sidebar_orders'); ?></a>
  <a href="user/files" class="list-group-item list-group-item-action <?php getActiveLink('files') ?>"><?= __('tpl_user_cabinet_sidebar_files'); ?></a>
  <a href="user/credentials" class="list-group-item list-group-item-action <?php getActiveLink('credentials') ?>"><?= __('tpl_user_cabinet_sidebar_credentials'); ?></a>
  <a href="user/logout" class="list-group-item list-group-item-action <?php getActiveLink('logout') ?>"><?= __('tpl_user_cabinet_sidebar_logout'); ?></a>
</div>