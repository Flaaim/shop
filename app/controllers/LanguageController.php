<?php

namespace App\controllers;

use App\controllers\AppController;
use App\Models\Cart;

class LanguageController extends AppController
{
    public function changeAction()
    {
        $lang = get('lang', 's');
        
        if($lang){
            if(array_key_exists($lang, \wfm\App::$app->getProperty('languages'))){
                $url = trim(str_replace(PATH, '', $_SERVER['HTTP_REFERER']), '/');
                $url_parts = explode('/', $url, 2);

                if(array_key_exists($url_parts[0], \wfm\App::$app->getProperty('languages'))){
                    if($lang != \wfm\App::$app->getProperty('language')['code']){
                        $url_parts[0] = $lang; 
                    }else{
                        array_shift($url_parts);
                    }
                }else{
                    if($lang != \wfm\App::$app->getProperty('language')['code']){
                        array_unshift($url_parts, $lang);
                    }
                }
                Cart::translateCart(\wfm\App::$app->getProperty('languages')[$lang]);
                $url = PATH .'/'.implode('/', $url_parts);
                redirect($url);
            }
        }
        redirect();
    }
}