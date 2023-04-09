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

