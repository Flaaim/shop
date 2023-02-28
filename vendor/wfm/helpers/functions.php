<?php 

function debug($data, $die = false){

    echo "<pre>". var_dump($data) . "</pre>";
    if($die){
        die();
    }
}