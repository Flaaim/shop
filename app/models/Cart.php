<?php

namespace App\Models;

use RedBeanPHP\R;
use App\Models\AppModel;

class Cart extends AppModel
{
    public function get_product($id, $lang): array
    {
        return R::getRow("SELECT * FROM product LEFT JOIN product_description
        ON product_description.product_id = product.id WHERE product.status = 1 AND product.id = ? AND product_description.language_id = ?", [$id, $lang['id']]);
    }

    public function add_to_cart($product, $qty = 1)
    {
        $qty = abs($qty);

        if(isset($_SESSION['cart'][$product['id']]) && $product['is_download']){
            return false;
        }
        
        if(isset($_SESSION['cart'][$product['id']])){
            $_SESSION['cart'][$product['id']]['qty'] += $qty;
        }else{
            if($product['is_download']){
                $qty = 1;
            }
            $_SESSION['cart'][$product['id']] = [
                'title' => $product['title'],
                'qty' => $qty,
                'price' => $product['price'],
                'img' => $product['img'],
                'slug' => $product['slug'],
                'is_download' => $product['is_download']
            ];
        }
        $_SESSION['cart.qty'] = !empty($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
        $_SESSION['cart.sum'] = !empty($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $qty*$product['price'] : $qty*$product['price'];
    }
    public function deleteItem($id)
    {
        $qty_minus = $_SESSION['cart'][$id]['qty'];
        $sum_minus = $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];

        $_SESSION['cart.qty'] -= $qty_minus;
        $_SESSION['cart.sum'] -= $sum_minus;
        unset($_SESSION['cart'][$id]);
    }
    public static function translateCart($lang)
    {
        if(empty($_SESSION['cart'])){
            return;
        }
        $ids = implode(',', array_keys($_SESSION['cart']));
        $products = R::getAll("SELECT product.id, product_description.title FROM product JOIN
        product_description ON product.id = product_description.product_id 
        WHERE id IN ($ids) AND language_id = ?", [$lang['id']]);
        foreach($products as $product){
            $_SESSION['cart'][$product['id']]['title'] = $product['title'];
        }
        
    }
}
