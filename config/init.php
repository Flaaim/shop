<?php

define("DEBUG", 1);
define("ROOT", dirname(__DIR__));
define("WWW", ROOT . "/public");
define("APP", ROOT . "/app");
define("CORE", ROOT . "/vendor/wfm");
define("HELPERS", ROOT . "/vendor/wfm/helpers");
define("CACHE", ROOT . "/tmp/cache");
define("LOGS", ROOT . "/tmp/logs");
define("CONFIG", ROOT . "/config");
define("LAYOUT", ROOT . "/ishop");
define("PATH", "http://ishop.test");
define("ADMIN", "http://ishop.test/admin");
define("NO_IMAGE", "uploads/no_image.jpg");


require_once(ROOT . '/vendor/autoload.php');