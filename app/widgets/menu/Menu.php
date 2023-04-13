<?php

namespace App\widgets\menu;

use RedBeanPHP\R;
use Wfm\App;
use Wfm\Cache;

class Menu
{
    protected $data;
    protected $tree;
    protected $menuHtml;
    protected $tpl = APP. '/widgets/menu/menu_tpl.php';
    protected $container = 'ul';
    protected $class = 'menu';
    protected $cache = 3600;
    protected $cacheKey = 'ishop_menu';
    protected $attrs = [];
    protected $prepend = '';
    protected $language;

    public function __construct($options = [])
    {
        $this->language = App::$app->getProperty('language');
        $this->getOptions($options);
        $this->run();
    }
    protected function getOptions($options)
    {
        foreach($options as $key => $value){
            if(property_exists($this, $key)){
                $this->$key = $value;
            }
        }
    }
    protected function run()
    {
        $cache = Cache::getInstance();
        $this->menuHtml = $cache->get("{$this->cacheKey}_{$this->language['code']}");
        if(!$this->menuHtml){
            $this->data = \wfm\App::$app->getProperty("categories_{$this->language['code']}");
            $this->tree = $this->getTree();
            
            $this->menuHtml = $this->getMenuHtml($this->tree);
            if($this->cache){
                    $cache->set("{$this->cacheKey}_{$this->language['code']}", $this->menuHtml, $this->cache);
            }
        }
        $this->output();

    
    }
    public function getTree()
    {
        $tree = [];
        $data = $this->data;
        foreach($data as $key => &$node){
            if(!$node['parent_id']){
                $tree[$key] = &$node; 
            } else {
                $data[$node['parent_id']]['children'][$key] = &$node;
            }
        }
        
        return $tree;
    }

    public function getMenuHtml($tree, $tab = '')
    {
        $str = '';
        foreach($tree as $id => $category){
            $str .= $this->catToTemplate($category, $tab, $id);
        }
        return $str;
    }
    public function catToTemplate($category, $tab, $id)
    {
        ob_start();
        require $this->tpl;
        return ob_get_clean();
    }
    public function output()
    {
        $attrs = '';
        if(!empty($this->$attrs)){
            foreach($this->$attrs as $k => $v){
                $attrs .= "$k=$v";
            }
        }
        echo "<{$this->container} class='{$this->class}' $attrs>";
        echo $this->prepend;
        echo $this->menuHtml;
        echo "</{$this->container}>";
        
    }

}