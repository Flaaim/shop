<?php

namespace App\controllers;

use App\controllers\AppController;
use RedBeanPHP\R;

class MainController extends AppController
{

    public function indexAction()
    {
        $slides = R::findAll('slider');
        $products = $this->model->get_hits(1, 3);
        
        $this->setData(compact('slides', 'products'));
        $this->setMeta('Главная страница', 'Description', 'Keywords');
        
    }
}