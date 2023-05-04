<?php

namespace Wfm;

use Wfm\Db;
use RedBeanPHP\R;

abstract class Model
{
    public array $attributes = [];
    public array $errors = [];
    public array $rules = [];
    public array $labels = [];

    public function __construct()
    {
        Db::getInstance();
    }
    public function load($data)
    {
        foreach($this->attributes as $key => $value){
            if(isset($data[$key])){
                $this->attributes[$key] = $data[$key];
            }
        }
    }
    public function save($table)
    {
        $tbl = R::dispense($table);
        foreach($this->attributes as $k => $v){
            if($v != ''){
                $tbl->$k = $v;
            }
        }
        return R::store($tbl);
    }
}