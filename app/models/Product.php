<?php

namespace App\Models;

use App\Models\AppModel;
use RedBeanPHP\R;

class Product extends AppModel
{
    public function getProduct($slug, $lang)
    {
        return R::getRow("SELECT * FROM product 
        LEFT JOIN product_description ON product.id = product_description.product_id 
        WHERE status = 1 AND product.slug = ? AND product_description.language_id = ?", [$slug, $lang]);
    }
    public function get_gallery($product_id)
    {
        return R::getAll("SELECT * FROM gallery WHERE product_id = ?", [$product_id]);
    }
}