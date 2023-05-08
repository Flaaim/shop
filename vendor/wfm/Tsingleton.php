<?php

namespace Wfm;

trait TSingleton
{
    protected static ?self $instance = null;

    private function __construct(){}

    public static function getInstance(): static
    {
        if(!self::$instance){
            return self::$instance = new static();
        }
        return self::$instance;
    }
}