<?php
namespace App\Middlewares;

use System\Facades\Session;

class Auth
{

	public static function handle()
	{
        if(Session::has('isLogin') && Session::has('user')){

        }else{
            redirect(route('adminLogin'));
        }

	}

}
