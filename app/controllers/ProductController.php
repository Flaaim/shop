<?php

namespace App\controllers;

use App\controllers\AppController;
use RedBeanPHP\R;
use App\Models\Breadcrumbs;

class ProductController extends AppController
{
    public function viewAction()
    {
        $lang = \wfm\App::$app->getProperty('language');
        $product = $this->model->getProduct($this->route['slug'], $lang['id']);
        if(empty($product)){
            throw new \Exception("Товар по запросу {$this->route['slug']} не найден!", 404);
        }
        $breadcrumbs = Breadcrumbs::getBreadcrumbs($product['category_id'], $product['title']);
        
        $gallery = $this->model->get_gallery($product['id']);
        $this->setMeta($product['title'], $product['description'], $product['keywords']);
        
        $this->setData(compact('product', 'gallery', 'breadcrumbs'));
    }
}