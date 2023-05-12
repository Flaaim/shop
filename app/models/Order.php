<?php

namespace App\Models;

use App\Models\AppModel;
use RedBeanPHP\R;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Order extends AppModel
{
    public static function saveOrder($data): int|false
    {
        R::begin();
        try{
            $order = R::dispense('orders');
            $order->user_id = $data['user_id'];
            $order->notation = $data['notation'];
            $order->total = $_SESSION['cart.sum'];
            $order->qty = $_SESSION['cart.qty'];
            $order_id = R::store($order);
            self::saveOrderProduct($order_id, $data['user_id']);
            R::commit();
            return $order_id;
        }catch(\Exception $e){
            throw new \Exception($e->getMessage(), $e->getCode());
            R::rollback();
            return false;
        }
    }

    public static function saveOrderProduct($order_id, $user_id)
    {
        $sql_part = '';
        $binds = [];
        foreach($_SESSION['cart'] as $product_id => $product){
            if($product['is_download']){
                $download_id = R::getCell("SELECT download_id FROM product_download WHERE product_id = ?", [$product_id]);
                $order_download = R::xdispense('order_download');
                $order_download->order_id = $order_id;
                $order_download->user_id = $user_id;
                $order_download->product_id = $product_id;
                $order_download->download_id = $download_id;

                R::store($order_download);
            }else{
                $sum = $product['qty'] * $product['price'];
                $sql_part .= "(?,?,?,?,?,?,?),";
                $binds = array_merge($binds, [$order_id, $product_id, $product['title'], $product['slug'], $product['qty'], $product['price'], $sum]);
                $sql_part = rtrim($sql_part, ',');

                R::exec("INSERT INTO order_product (order_id, product_id, title, slug, qty, price, sum) VALUES $sql_part", $binds);
            }

        }
    }

    public static function sendOrderEmail($user_email, $order_id, $tpl): bool
    {
        $mail = new PHPMailer(true);

        try{
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->CharSet = 'UTF-8';
            $mail->Host = \Wfm\App::$app->getProperty('smtp_host');
            $mail->SMTPAuth = \Wfm\App::$app->getProperty('smtp_auth');
            $mail->Username = \Wfm\App::$app->getProperty('smtp_username');
            $mail->Password = \Wfm\App::$app->getProperty('smtp_password');
            $mail->SMTPSecure  = \Wfm\App::$app->getProperty('smtp_secure');
            $mail->Port  = \Wfm\App::$app->getProperty('smtp_port');

            $mail->setFrom(\Wfm\App::$app->getProperty('admin_email'), \Wfm\App::$app->getProperty('site_name'));
            $mail->addAddress($user_email);
            $mail->Subject = sprintf(___('tpl_cart_checkout_mail_subject'), $order_id);

            ob_start();
            require APP."/views/Mail/{$tpl}.php";
            $body = ob_get_clean();
            $mail->Body = $body;
            return $mail->send();
        }catch(\Exception $e){
           // throw new Exception($e->getMessage(), $e->getCode());
            return false;
        }
    }
}