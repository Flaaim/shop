<?php

namespace app\models;

use Wfm\Model;
use RedBeanPHP\R;

class Main extends Model
{
    public function get_names()
    {
        return R::findAll("names");
    }
}