<?php

namespace App\controllers;

use Wfm\Controller;
use App\models\AppModel;
use App\widgets\languages\Language;
use Wfm\App;

class AppController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
        new AppModel();
        App::$app->setProperty('languages', Language::getLanguages());
        App::$app->setProperty('language', Language::getLanguage(App::$app->getProperty('languages')));
        $lang = App::$app->getProperty('language');
        \Wfm\Language::load($lang['code'], $this->route);
    }
}