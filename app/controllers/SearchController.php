<?php

namespace App\Controllers;

use App\Controllers\AppController;
use Wfm\Pagination;

class SearchController extends AppController
{
    public function indexAction()
    {
        $s = get('s', 's');
        $page = get('page');
        $lang = \Wfm\App::$app->getProperty('language');
        $perpage = \Wfm\App::$app->getProperty('pagination');
        $total = $this->model->get_count_find_products($lang, $s);
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();
        $products = $this->model->get_find_products($lang, $s, $start, $perpage);
        $this->setMeta(___('tpl_search_title'), ___('tpl_search_description'), '');
        $this->setData(compact('s', 'products', 'total', 'pagination'));
    }
}