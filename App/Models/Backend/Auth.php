<?php

namespace App\Models\Backend;

use DB;

class Auth
{
    public function isLogin($userMail,$password){
        return DB::table('user as u')
            ->where('u.user_mail','=',$userMail)
            ->where('u.user_password','=',$password)
            ->where('u.user_status','=',1)
            ->limit('1')
            ->getRow();
    }
}
