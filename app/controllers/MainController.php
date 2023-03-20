<?php

namespace App\controllers;

use App\controllers\AppController;
use RedBeanPHP\R;

class MainController extends AppController
{

    public function __construct($route)
    {
        parent::__construct($route);
    }

    public function indexAction()
    {
        $slides = R::findAll('slider');
        $products = $this->model->get_hits(1, 3);
        
        $this->setData(compact('slides', 'products'));
        
    }
}