<?php

namespace App\Controllers;

use App\Controllers\AppController;

class WishlistController extends AppController
{
    public function addAction()
    {
        $id = get('id');
        if(!$id){
            $answer = ['result' => 'error', 'text' => 'ERROR'];
            exit(json_encode($answer));
        }
        $product = $this->model->get_product($id);
        if($product){
            $this->model->add_to_wishlist($product);
            $answer = ['result' => 'success', 'text' => 'Product successfully add to your wishlist'];
        }else{
            $answer = ['result' => 'error', 'text' => 'ERROR'];
        }
        exit(json_encode($answer));
    }
    public function indexAction()
    {
        $lang = \Wfm\App::$app->getProperty('language');
        $products = $this->model->get_wishlist_products($lang);
        $this->setMeta(___('tpl_wishlist_title'), ___('tpl_wishlist_description'), '');
        $this->setData(compact('products'));
    }
    public function deleteAction()
    {
        $id = get('id');
        if($this->model->delete_from_wishlist($id)){
            $answer = ['result' => 'success', 'text' => 'Product successfully delete from your wishlist'];
        }else {
            $answer = ['result' => 'error', 'text' => 'ERROR'];
        }
        exit(json_encode($answer));
        
    }
}