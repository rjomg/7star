<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Users;

class LoginController extends Controller{

    //显示后台登录界面
    public function index() {
        return view("login.login");
    }

    //登录验证
    public function loginHandle(Request $request) {
        $username = $request->username;
        $password = $request->password;

        $user = new Users();
        print_r($user->loginValidate($username,$password));
    }
}
