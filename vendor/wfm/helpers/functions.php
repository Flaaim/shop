<?php 

function debug($data, $die = false){

    echo "<pre>". var_dump($data) . "</pre>";
    if($die){
        die();
    }
}

function redirect($http = false)
{
    if($http){
        $redirect = $http;
    }else{
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
    }
    header("Location: $redirect");
    die;
}
function h($data)
{
    return htmlspecialchars($data);
}
function base_url()
{
    return PATH . '/'.(\wfm\App::$app->getProperty('lang') ? \wfm\App::$app->getProperty('lang').'/' : "");
}
function get($key, $type = 'i')
{
    $param = $key;
    $$param = $_GET[$param] ?? "";
    if($type == "i"){
        return (int) $$param;
    }elseif($type == 'f'){
        return (float)$$param;
    }else{
        return trim($$param);
    }
}
function post($key, $type = 's'){
    $param = $key;
    $$param = $_POST[$param] ?? "";
    if($type == 'i'){
        return (int)$$param;
    }elseif($type == 'f'){
        return (float)$$param;
    }else{
        return trim($$param);
    }
}

function __($key){
    echo \Wfm\Language::get($key);
}

function ___($key){
    return \Wfm\Language::get($key);
}

function get_cart_icon($id)
{
    if(!empty($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart'])){
        $icon = "<i id='product-{$id}' class='fas fa-shopping-bag'></i>";
    }else{
        $icon = "<i id='product-{$id}' class='fas fa-shopping-cart'></i>";
    }
    return $icon;
}

function get_field_values($name)
{
    return isset($_SESSION['form_data'][$name]) ? h($_SESSION['form_data'][$name]) : '';
}

function getActiveLink($link)
{
    $url = $_SERVER['REQUEST_URI'];
    $url_parts = trim(parse_url($url, PHP_URL_PATH), '/');
    $url_parts = explode('/', $url_parts);
    $count = count($url_parts) - 1;
    // debug($url_parts);
    if($link == $url_parts[$count]){
        echo "active";
    }
}
