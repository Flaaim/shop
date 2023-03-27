<?php

namespace App\widgets\languages;

use RedBeanPHP\R;
use Wfm\App;

class Language
{
    protected $tpl;
    protected $language;
    protected $languages;

    public function __construct()
    {
        $this->tpl = __DIR__ . '/lang_tpl.php';
        $this->run();
    }

    public function run()
    {
        $this->languages = App::$app->getProperty('languages');
        $this->language = App::$app->getProperty('language');
        echo $this->getHtml();
    }
    public static function getLanguages(): array
    {
       return R::getAssoc("SELECT code, title, base, id FROM language ORDER by base DESC");
    }
    public static function getLanguage($languages): array
    {
        
        $lang = App::$app->getProperty('lang');
        
        if($lang && array_key_exists($lang, $languages)){
            $key = $lang;
        }elseif(!$lang){
            $key = key($languages);
        }else{
           
            throw new \Exception("Language {$lang} not found", 404);
        }
        $lang_info = $languages[$key];
        $lang_info['code'] = $key;
        return $lang_info;
    }
    protected function getHtml()
    {
        ob_start();
        require_once "lang_tpl.php";
        return ob_get_clean();
    }
}