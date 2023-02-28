<?php

namespace Wfm;

class Router
{
    protected static array $routes = [];
    protected static array $route = [];

    public static function add($regex, $route = [])
    {
        self::$routes[$regex] = $route;
    }
    public function getRoutes(): array
    {
        return self::$routes;
    }
    public function getRoute()
    {
        return self::$route;
    }
    protected static function removeQueryString($url): string
    {
        if($url){
            $params = explode('&', $url, 2);
            debug($params);
            
            return rtrim($params[0], '/');
            
        }
        return '';
    }
    protected static function changeQuesting($url): string
    {
        return str_replace('?', '&', $url);
    }
    public static function dispatch($url)
    {
        $url = self::changeQuesting($url);
        $url = self::removeQueryString($url);
        
        if(self::matchRoute($url)){
            $controller = "App\controllers\\".self::$route['admin_prefix'].self::$route['controller'].'Controller';
            
            if(class_exists($controller)){
                $controllerObject = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action'].'Action');
                if(method_exists($controllerObject, $action)){
                    $controllerObject->$action();
                }
            } else{
                throw(new \Exception("Контроллер не найден"));
            }
        }else{
            throw(new \Exception("Страница не найдена"));
        }
    }
    public static function matchRoute($url): bool 
    {   
        foreach(self::$routes as $pattern => $route){
           if(preg_match("#{$pattern}#", $url, $matches)){   
                foreach($matches as $key => $v){
                    if(is_string($key)){
                        $route[$key] = $v; 
                    }
                    if(empty($route['action'])){
                        $route['action'] = 'index';
                    }
                }
                if(!isset($route['admin_prefix'])){
                    $route['admin_prefix'] = '';
                }else{
                    $route['admin_prefix'] .= '\\';
                }

                $route['controller'] = self::upperCamelCase($route['controller']);
                $route['action'] = self::lowerCamelCase($route['action']);
                self::$route = $route;
                debug(self::$route);
                return true;
            }
        }
        
        return false;
    }
    public static function upperCamelCase($name): string
    {
        return str_replace('-', '', ucwords($name, '-'));
    }
    public static function lowerCamelCase($name): string
    {
        return lcfirst(self::upperCamelCase($name));
    }
}