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

    public function cabinetAction()
    {
        if(!User::checkAuth()){
            redirect(base_url()."user/signin");
        }
        getActiveLink('test');
    }
    public function ordersAction()
    {
        if(!User::checkAuth()){
            redirect(base_url()."user/signin");
        }  

        $orders = $this->model->getOrders($_SESSION['user']['id']);
        $this->setData(compact('orders'));
    }

    public function viewAction()
    {
        if(!User::checkAuth()){
            redirect(base_url()."user/signin");
        } 
        $id = get('id');
        $order = $this->model->getOrder($id);
        
        if(!$order){
            throw new \Exception(___('tpl_view_order_not_found'), 404);
        }
        $this->setData(compact('order'));
    }
    public function filesAction()
    {
        if(!User::checkAuth()){
            redirect(base_url()."user/signin");
        }
        $lang = \Wfm\App::$app->getProperty('language');
        $files = $this->model->getFiles($_SESSION['user']['id'], $lang);
        if(!$files){
            throw new \Exception("Files not found", 404);
        }
        $this->setData(compact('files'));
    }
    public function downloadAction()
    {
        if(!User::checkAuth()){
            redirect(base_url()."user/signin");
        }
        $id = get('id');
        $lang = \Wfm\App::$app->getProperty('language');
        $file = $this->model->get_user_file($id, $lang);
        
        if($file){
            $path = WWW."/downloads/{$file['filename']}";
            if(file_exists($path)){
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: filename="'.basename($file['original_name']).'"');
                header("Expires: 0");
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header('Pragma: public');
                header('Content-Length: '. filesize($path)); 
                readfile($path);
                exit();
            }else{
                $_SESSION['errors'] = ___('tpl_file_download_error');
            }
        }
        redirect();
    }
        
}