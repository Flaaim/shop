<?php

namespace App\Controllers;

use App\Controllers\AppController;

class PageController extends AppController
{
    public function viewAction()
    {
        $lang = \Wfm\App::$app->getProperty('language');
        $page = $this->model->get_page($this->route['slug'], $lang);
        if(!$page){
            throw new \Exception("Page not found", 404);
        }
        $this->setMeta($page['title'], $page['description'], '');
        $this->setData(compact('page'));
    }
}