<?php

namespace App\Models;

use App\Models\AppModel;
use Valitron\Validator;
use RedBeanPHP\R;

class User extends AppModel
{
    public array $attributes = [
        'email' => '',
        'name' => '',
        'password' => '',
        'address' => ''
    ];

    public array $rules = [
        'required' => ['email', 'name', 'password', 'address', 'confirm_password'],
        'email' => ['email'],
        'equals' => [
            ['password', 'confirm_password']
        ],
        'lengthMin' => [
            ['password', 6]
        ]
    ];

    public array $labels = [
        'name' => 'tpl_signup_label_name',
        'email' => 'tpl_signup_label_email',
        'address' => 'tpl_signup_label_address',
        'password' => 'tpl_signup_label_password',
        'confirm_password' => 'tpl_signup_label_confirm_password'
    ];


    public static function checkAuth(): bool
    {
        return isset($_SESSION['user']);
    }
    public function validate($data)
    {
        $lang = \Wfm\App::$app->getProperty('language');
        Validator::langDir(APP."/languages/validate/lang");
        Validator::lang($lang['code']);
        $validator = new Validator($data);
        $validator->rules($this->rules);
        $this->attributes['password'] = password_hash($this->attributes['password'], PASSWORD_DEFAULT);
        $validator->labels($this->getLabels());
        if($validator->validate()){
            return true;
        }else{
            $this->errors = $validator->errors();
            $_SESSION['form_data'] = $data;
            return false;
        }
    }

    public function getErrors()
    {

        $errors = "<ul>";
        foreach($this->errors as $error){
            foreach($error as $item){
                $errors .= "<li>{$item}</li>";
            }
        }
        $errors .= "</ul>";
        $_SESSION['errors'] = $errors;
    }
    public function getLabels()
    {
        $labels = [];
        foreach($this->labels as $k => $v){
            $labels[$k] = ___($v);
        }
        return $labels;
    }
    public function checkUnique($text_error = ''): bool
    {
        $user = R::findOne('user', 'email = ?', [$this->attributes['email']]);
        if($user){
            $this->errors['unique'][] = 'Этот емайл уже занят';
            return false;
        }else{
            return true;
        }
    }

    public function login($is_admin = false): bool
    {
        $email = post('email');
        $password = post('password');

        if($email && $password){
            if($is_admin){
               $user = R::findOne('user', "email = ? AND role = 'admin'", [$email]);
            }else{
                $user = R::findOne('user', "email = ?", [$email]);
            }
            if($user){
                if(password_verify($password, $user->password)){
                    foreach($user as $key => $property){
                        if($key != 'password'){
                            $_SESSION['user'][$key] = $property;
                        }
                       
                    }
                    
                    $_SESSION['success'] = ___('tpl_signin_login_success');
                    return true;
                }
                $_SESSION['errors'] = ___('tpl_signin_error_password');
                return false;
            }
            $_SESSION['errors'] = ___('tpl_signin_error_email');
            return false;
        }else{
            $_SESSION['errors'] = ___('tpl_signin_error_not_found');
            return false;
        }  
    }

    public function getOrders($user_id): array
    {
        return R::getAll("SELECT * FROM orders WHERE user_id = ? ORDER by id DESC",[$user_id]);
    }
    public function getOrder($id): array
    {
        return R::getAll("SELECT * FROM orders JOIN order_product ON orders.id = order_product.order_id 
        WHERE orders.id = ?", [$id]);
    }
    public function getFiles($user_id, $lang): array
    {
        return R::getAll("SELECT * FROM order_download JOIN download ON order_download.download_id = download.id
        JOIN download_description ON download.id = download_description.download_id WHERE user_id = ? AND language_id = ? AND status = 1", [$user_id, $lang['id']]);
    }

    public function get_user_file($id, $lang): array
    {
        return R::getRow("SELECT * FROM order_download JOIN download ON order_download.download_id = download.id JOIN download_description ON download.id = download_description.download_id WHERE status = 1 AND download_description.language_id = ? AND order_download.user_id = ? AND download.id = ?", [$lang['id'], $_SESSION['user']['id'], $id]);
    }
}   