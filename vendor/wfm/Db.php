<?php

namespace Wfm;

use Wfm\TSingleton;
use RedBeanPHP\R;

class Db
{
    use TSingleton;

    private function __construct()
    {
        require_once CONFIG . '/configDb.php';
        R::setup($db['dsn'], $db['user'], $db['password']);
        if(!R::testConnection()){
            throw new \Exception("No connection", 500);
        }
        R::freeze(true);
        if(DEBUG){
            R::debug(true, 3);
        }
        R::ext('xdispense', function( $type ){ 
            return R::getRedBean()->dispense( $type ); 
        });
    }
}