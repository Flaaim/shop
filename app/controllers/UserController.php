<?php

namespace App\Controllers;

use App\Controllers\AppController;
use App\Models\User;

class UserController extends AppController
{
    public function signupAction()
    {
        if(User::checkAuth()){
            redirect(base_url());
        }

        if(!empty($_POST)){
            $data = $_POST;
            $this->model->load($data);
            
            if($this->model->validate($data) && $this->model->checkUnique()){
                if($this->model->save('user')){
                    $_SESSION['success'] = ___('tpl_signup_success_registration');
                }else{
                    $_SESSION['errors'] = ___('tpl_signup_register_error');
                }
            } else {
                $this->model->getErrors();
            }
            
        }
    }
    public function signinAction()
    {
        if(User::checkAuth()){
            redirect(base_url());
        }

        if(!empty($_POST)){
            
            if($this->model->login()){
                
               redirect(base_url());
            }else{
                redirect(base_url(). 'user/signin');
            }
        }
    }

    public function logoutAction()
    {
        unset($_SESSION['user']);
        redirect(base_url().'user/signin');
    }

        
}