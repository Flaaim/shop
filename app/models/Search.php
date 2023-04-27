<?php

namespace App\Models;

use App\Models\AppModel;
use RedBeanPHP\R;

class Search extends AppModel
{
    public function get_count_find_products($lang, $s): int
    {
        return R::getCell("SELECT count(id) FROM product JOIN product_description ON
        product.id = product_description.product_id WHERE status = 1 AND language_id = ? AND title LIKE ?",[$lang['id'], "%{$s}%"]);
    }

    public function get_find_products($lang, $s, $start, $perpage): array
    {
        return R::getAll("SELECT product.*, product_description.* FROM product JOIN product_description ON
        product.id = product_description.product_id WHERE status = 1 AND language_id = ? AND title LIKE ? LIMIT $start, $perpage", [$lang['id'], "%{$s}%"]);
    }
}