<?php

require_once(dirname(__DIR__) . '/config/init.php');

use Wfm\App;

$app = new App();
//echo $test;

throw new Exception('Ошибочка', 500);
//var_dump(App::$app->getProperties());
