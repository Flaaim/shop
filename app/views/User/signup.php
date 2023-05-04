<?php

use Wfm\View;

?>

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light p-2">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>"><i class="fas fa-home"></i></a></li>
            <li class="breadcrumb-item"><?= __('tpl_signup_title') ?></li>
        </ol>
    </nav>
</div>
<div class="container py-3">
<div class="col-lg-12 category-content">
    <h1 class="section-title"><?= __('tpl_signup_title') ?></h1>

</div>

    <div class="row">
        <div class="d-flex justify-content-center">
            <div class="col-md-10">
                <form method="POST">
                    <div class="form-group row my-3">
                        <label for="email" class="col-md-2 col-form-label"><?= __('tpl_signup_form_email') ?></label>
                        <div class="col-md-8">
                            <input type="email" class="form-control" name="email" id="email" placeholder="<?= __('tpl_signup_placeholder_email') ?>" value="<?= get_field_values('email') ?>">
                        </div>
                    </div>
                    <div class="form-group row my-3">
                        <label for="name" class="col-md-2 col-form-label"><?= __('tpl_signup_form_name') ?></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="name" id="name" placeholder="<?= __('tpl_signup_placeholder_name') ?>" value="<?= get_field_values('name') ?>">
                        </div>
                    </div>
                    <div class="form-group row my-3">
                        <label for="address" class="col-md-2 col-form-label"><?= __('tpl_signup_form_address') ?></label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="address" id="address" placeholder="<?= __('tpl_signup_placeholder_address') ?>" value="<?= get_field_values('address') ?>">
                        </div>
                    </div>
                    <div class="form-group row my-3">
                        <label for="password" class="col-md-2 col-form-label"><?= __('tpl_signup_form_password') ?></label>
                        <div class="col-md-8">
                            <input type="password" class="form-control" name="password" id="password" placeholder="<?= __('tpl_signup_placeholder_password') ?>">
                        </div>
                    </div>
                    <div class="form-group row my-3">
                        <label for="confirm_password" class="col-md-2 col-form-label"><?= __('tpl_signup_form_confirm_password') ?></label>
                        <div class="col-md-8">
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="<?= __('tpl_signup_placeholder_confirm_password') ?>">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-danger"><?= __('tpl_signup_form_button') ?></button>
                    
                </form>
                <?php 
                if(isset($_SESSION['form_data'])){
                    unset($_SESSION['form_data']); 
                }
               
                
                ?>
            </div>
        </div>

    </div>
</div>