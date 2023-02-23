<?php

namespace Wfm;

class ErrorHandler
{
    public function __construct()
    {

        if (DEBUG) {
            error_reporting(-1);
        } else {
            error_reporting(0);
        }
        set_exception_handler([$this, 'exceptionHandler']);
        set_error_handler([$this, 'errorHandler']);
        ob_start();
        register_shutdown_function([$this, 'fatalErrorHandler']);
    }

    public function exceptionHandler(\Throwable $e)
    {
        $this->logError($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }
    public function errorHandler($errno, $errstr, $errfile, $errlin)
    {
        $this->logError($errstr, $errfile, $errlin);
        $this->displayError($errno, $errstr, $errfile, $errlin);
    }
    public function fatalErrorHandler()
    {
        $error = error_get_last();
        if (!empty($error) && $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR)) {
            $this->logError($error['message'], $error['file'], $error['line']);
            ob_end_clean();
            $this->displayError($error['type'], $error['message'], $error['file'], $error['line']);
        } else {
            ob_end_flush();
        }
    }
    protected function logError($message = '', $file = '', $lin = '')
    {
        file_put_contents(LOGS . '/errors.log', "[" . date("d.m.Y h:i:s ") . "Сообщение: " . $message . " Файл: " . $file . " Строка: " . $lin . " ]\r\n", FILE_APPEND);
    }
    protected function displayError($errno, $errstr, $errfile, $errlin, $response = 500)
    {
        if ($response == 0) {
            $response = 404;
        }
        http_response_code($response);
        if ($response == 404 && !DEBUG) {
            require_once(WWW . '/error/404.php');
        }
        if (DEBUG) {
            require_once(WWW . '/errors/development.php');
        } else {
            require_once(WWW . '/errors/production.php');
        }
        die;
    }
}
