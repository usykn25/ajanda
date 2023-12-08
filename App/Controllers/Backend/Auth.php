<?php
namespace App\Controllers\Backend;

use System\Facades\Model;
use System\Facades\Request;
use System\Facades\Session;
use System\Kernel\Controller;
use View;

class Auth extends Controller
{

    public function login()
    {
        if(Session::has('isLogin')){
            redirect(route('adminHome'));
        }else{
            View::render('Backend/login');
            exit;
        }
    }

    public function loginPost(){
        if (csrf_check(Request::post('_token')) && Request::isAjax() && Request::isMethod('POST')) {
            $userMail = Request::post('userMail');
            $password = Request::post('password');
            $hashPassword = hash('sha256', $password );
            $result = Model::Run('Auth','Backend')->isLogin($userMail,$hashPassword);
            if($result){
                Session::set('isLogin','true');
                Session::set('user',$result);
                $data = [
                    "IsSuccess" => true,
                    "Title" => "Giriş Yapıldı",
                    "Message" => "Hoşgeldin ".$result->user_nameSurname." Yönlendiriliyorsunuz.",
                    "Type" => "success",
                    "Redirect" => route('adminHome')
                ];
            }else{
                $data = [
                    "IsSuccess" => false,
                    "Title" => "Hata",
                    "Message" => "Kullanıcı Adı Şifre Yanlış !.",
                    "Type" => "error",
                    "Redirect" => $_SERVER['HTTP_REFERER']
                ];
            }
            echo json_encode($data);
            exit;
        } else {
            redirect(route('adminLogin'));
            exit;
        }
    }

    public function logout(){
        Session::delete('isLogin');
        Session::delete('user');
        redirect(route('adminLogin'));
    }

}
