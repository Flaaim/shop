<?php

namespace App\controllers;

use App\controllers\AppController;
use RedBeanPHP\R;
use Wfm\App;

class MainController extends AppController
{

    public function indexAction()
    {
        $slides = R::findAll('slider');
        $lang = App::$app->getProperty('language');
        $products = $this->model->get_hits($lang, 6);
        
        $this->setData(compact('slides', 'products'));
        $this->setMeta(___('main_index_meta_title'), ___('main_index_meta_description'), ___('main_index_meta_keywords'));
        
    }
}