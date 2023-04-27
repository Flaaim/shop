<?php

namespace App\Controllers;

use App\Controllers\AppController;
use App\Models\Breadcrumbs;
use Wfm\Pagination;

class CategoryController extends AppController
{
    public function viewAction()
    {
        $lang = \Wfm\App::$app->getProperty('language');
        $category = $this->model->get_category($this->route['slug'], $lang);
        if(empty($category)){
            throw new \Exception("Category not found");
        }
        $ids = $this->model->getIds($category['id']);
        $ids = !$ids ? $category['id'] : $ids. $category['id'];

        $page = get('page');
        $perpage = \Wfm\App::$app->getProperty('pagination');
        if(isset($_GET['count'])){
            $perpage = get('count');
        }
        $total = $this->model->get_count_products($ids);
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();
        $breadcrumbs = Breadcrumbs::getBreadcrumbs($category['id']);
        $products = $this->model->get_products($ids, $start, $perpage); 
        
        $this->setMeta($category['title'], $category['description'], $category['keywords']);
        $this->setData(compact('category', 'products', 'breadcrumbs', 'pagination', 'total'));
        
    }
}