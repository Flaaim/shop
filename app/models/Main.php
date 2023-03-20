<?php

namespace App\Models;

use App\Models\AppModel;
use RedBeanPHP\R;

class Main extends AppModel
{
    public function get_names()
    {
        return R::findAll("names");
    }

    public function get_hits($lang, $limit)
    {
        return R::getAll("SELECT * FROM product p 
        JOIN product_description pd ON p.id = pd.product_id
        WHERE p.status = 1 AND p.hit = 1 AND pd.language_id = ? LIMIT $limit", [$lang]);
    }
}