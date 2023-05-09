<?php

namespace App\controllers;

use App\controllers\AppController;
use RedBeanPHP\R;
use Wfm\App;
use App\Models\User;
use App\Models\Order;

class CartController extends AppController
{
    public function addAction()
    {
        $id = get('id');
        $qty = get('qty');
        
        $lang = App::$app->getProperty('language');
       
        if(!$id){
            return false;
        }
        
        $product = $this->model->get_product($id, $lang);
        if(empty($product)){
            return false;
        }
        $this->model->add_to_cart($product, $qty);
        if($this->isAjax()){
            $this->loadView('cart_modal');
        }
        redirect();
           
    }
    public function showAction()
    {
        if($this->isAjax()){
            $this->loadView('cart_modal');
        }
    }
    public function deleteAction()
    {
        $id = get('id');
        if(isset($_SESSION['cart'][$id])){
            $this->model->deleteItem($id);
        }
        if($this->isAjax()){
            $this->loadView('cart_modal');
        }
        redirect();
    }
    public function clearAction()
    {
        if(empty($_SESSION['cart'])){
            return false;
        }
        unset($_SESSION['cart']);
        unset($_SESSION['cart.qty']);
        unset($_SESSION['cart.sum']);
        $this->loadView('cart_modal');
        return true;
    }

    public function viewAction()
    {
        
        $this->setMeta(___('tpl_cart_view_title'), ___('tpl_cart_view_description'), '');
    }

    public function checkoutAction()
    {
        if(!empty($_POST)){
            $data = $_POST;
            if(!User::checkAuth()){
                //регистрируем пользователя
                $user = new User;
                $data = $_POST;
                $user->load($data);
                if($user->validate($data) && $user->checkUnique()){
                    if(!$user_id = $user-save('user')){
                        $_SESSION['errors'] = ___('cart_checkout_error_register');
                        redirect();
                    }
                } else {
                    $user->getErrors();
                    redirect();
                }
            }
            //сохранение заказа
            $data['user_id'] = $user_id ?? $_SESSION['user']['id'];
            $data['notation'] = post('notation');
            $user_email = $_SESSION['user']['email'] ?? post('email');
            if(!$order_id = Order::saveOrder($data)){
                $_SESSION['errors'] = ___('tpl_cart_checkout_save_error_order');
            } else{
                //выгружаем заказ, очищаем козрзину

                $_SESSION['success'] = ___('tpl_cart_checkout_order_success');
            }
        }
        redirect();
        
    }
}