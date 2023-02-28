<?php

namespace Wfm;

use Wfm\Registry;
use Wfm\ErrorHandler;
use Wfm\Router;

class App
{
    public static $app;

    public function __construct()
    {
        $query = trim(urldecode($_SERVER['REQUEST_URI']), '/');
        self::$app = Registry::getInstance();
        $this->getParams();
        new ErrorHandler();
        Router::dispatch($query);
    }
    public function getParams()
    {
        if (!file_exists(CONFIG . '/params.php')) {
            die("Файл с параметрами не найден");
        }
        $params = require_once CONFIG . '/params.php';

        if (!empty($params)) {
            foreach ($params as $k => $v) {
                self::$app->setProperty($k, $v);
            }
        }
    }
}
