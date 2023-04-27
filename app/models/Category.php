<?php

namespace App\Models;

use App\Models\AppModel;
use RedBeanPHP\R;

class Category
{
    public function get_category($slug, $lang)
    {
        return R::getRow("SELECT * FROM category JOIN 
        category_description ON category.id = category_description.category_id
        WHERE slug = ? AND language_id = ?", [$slug, $lang['id']]);
        
    }

    public function getIds($id)
    {
        $lang = \Wfm\App::$app->getProperty('language');
        $categories = \Wfm\App::$app->getProperty("categories_{$lang['code']}");
        $ids = '';
        foreach($categories as $k => $v){
            if($v['parent_id'] == $id){
                $ids .= $k.",";
                $ids .= $this->getIds($k);
            }

        }
        return $ids;
    }

    public function get_products($ids, $start, $perpage)
    {
        $order = [
            'title_asc' => 'ORDER by title ASC',
            'title_desc' => 'ORDER by title DESC',
            'price_asc' => 'ORDER by price ASC',
            'price_desc' => 'ORDER by price DESC',
        ];
        // $count = [
        //     '3' => '3',
        //     '5' => '5',
        //     '7' => '7',
        //     '10' => '10',
        //     '15' => '15',
        // ];
       

        
        $order_by = '';
        if(isset($_GET['sort']) && array_key_exists($_GET['sort'], $order)){
            $order_by = $order[$_GET['sort']];
        }
        $lang = \Wfm\App::$app->getProperty('language');
        return R::getAll("SELECT * FROM product JOIN product_description ON
        product.id = product_description.product_id WHERE status = 1 AND category_id IN ($ids) AND language_id = ? $order_by LIMIT $start, $perpage", [$lang['id']]);
    }
    public function get_count_products($ids)
    {
        return R::count("product", "WHERE status = 1 AND category_id IN ($ids)");
    }
}