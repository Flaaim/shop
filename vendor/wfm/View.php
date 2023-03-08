<?php

namespace Wfm;

use RedBeanPHP\R;

class View
{
    public string $content = '';

    public function __construct(
        public $route,
        public $layout = '',
        public $view = '',
        public $meta = []
    ){
        if($this->layout !== false){
            $this->layout = $this->layout ?: LAYOUT;
        }
    }
    public function render($data)
    {
        if(is_array($data)){
            extract($data);
        }
        
        $prefix = str_replace('\\', '/', $this->route['admin_prefix']);
        
        $view_file = APP."/views/{$prefix}{$this->route['controller']}/{$this->view}.php";
        
        if(is_file($view_file)){
            ob_start();
            require_once $view_file;
            $this->content = ob_get_clean();
        }else{
            throw (new \Exception("Вид {$view_file} не найден"));
        }
        if($this->layout !== false){
            $layout_file = APP."/views/layouts/{$this->layout}.php";
            if(file_exists($layout_file)){
                require_once $layout_file;
            } else{
                throw (new \Exception("Шаблон $layout_file не найден"));
            }
        }
    }
    public function getMeta()
    {
        $out = "<title>".$this->meta['title']."</title>";
        $out .= "<meta name=\"description\" content=\"{$this->meta['description']}\">". PHP_EOL;
        $out .= "<meta name=\"keywords\" content=\"{$this->meta['keywords']}\">". PHP_EOL;
        return $out;
    }
    public function getDbLogs()
    {
        if(DEBUG){
        $logs = R::getDatabaseAdapter()
            ->getDatabase()
            ->getLogger();
        $logs = array_merge($logs->grep("SELECT"), $logs->grep("INSERT"), $logs->grep("UPDATE"), $logs->grep("DELETE"));
        debug($logs);
        }
    }
    public function getPart($file, $data = '')
    {
        if(is_array($data)){
            extract($data);
        }
        $file = APP . "/views/parts/{$file}.php";
        if(is_file($file)){
            require $file;
        } else {
            echo "File {$file} not found...";
        }
    }
}   