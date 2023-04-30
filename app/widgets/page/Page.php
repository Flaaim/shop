<?php

namespace App\Widgets\Page;

use RedBeanPHP\R;
use Wfm\App;
use Wfm\Cache;

class Page
{
    protected $data;
    protected $container = 'ul';
    protected $pageHtml;
    protected $cache = 3600;
    protected $cacheKey = 'ishop_page';
    protected $language;
    protected $class = 'list-unstyled';
    protected $prepend = 'tpl_homepage';

    public function __construct($options = [])
    {
        $this->language = \Wfm\App::$app->getProperty('language');
        $this->setOptions($options);
        $this->run();
    }

    public function setOptions($options)
    {
        foreach($options as $key => $value){
            if(property_exists($this, $key)){
                $this->$key = $value;
            }
        }
    }

    public function run()
    {
        $cache = Cache::getInstance();
        $this->pageHtml = $cache->get("{$this->cacheKey}_{$this->language['code']}");
        if(!$this->pageHtml){
            $this->data = R::getAll("SELECT * FROM page JOIN page_description ON page.id = page_description.page_id WHERE language_id = ?", [$this->language['id']]);
            //debug($this->data, 1);
            $this->pageHtml = $this->getPageHtml();
            if($this->cache){
                $cache->set("{$this->cacheKey}_{$this->language['code']}", $this->pageHtml);
            }
        }
        $this->output();
    }
    public function getPageHtml()
    {
        $html = '';
        foreach($this->data as $value){
            $html .= "<li><a href='page/".$value['slug']."'>".$value['title']."</a></li>";
        }
        return $html;
        
    }
    public function output()
    {
        if($this->prepend){
            $prepend = "<li><a href='".base_url()."'>".___($this->prepend)."</a></li>";
        }
        echo "<{$this->container} class='$this->class'>";
        echo $prepend;
        echo $this->pageHtml;
        echo "</$this->container>";
    }
}

