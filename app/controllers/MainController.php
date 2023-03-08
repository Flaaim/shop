<?php

namespace app\controllers;

use Wfm\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        $this->setMeta('Тестовый заголовок', 'Тестовое описание', 'Тестовые ключевые слова');
    }
}