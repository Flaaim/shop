<?php

namespace App\controllers;

use App\controllers\AppController;
use RedBeanPHP\R;
use Wfm\App;

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
}