<?php

namespace App\controllers;

use Wfm\Controller;
use App\models\AppModel;
use App\widgets\languages\Language;
use Wfm\App;
use App\Models\Cart;
use RedBeanPHP\R;
use App\Models\Wishlist;

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
        $categories = R::getAssoc("SELECT * FROM category JOIN category_description 
        ON category.id = category_description.category_id WHERE category_description.language_id = ? 
        ", [$lang['id']]);
        \wfm\App::$app->setProperty("categories_{$lang['code']}", $categories);
        \Wfm\App::$app->setProperty('wishlist', Wishlist::get_wishlist_ids());
        debug($_SESSION);
    }
}