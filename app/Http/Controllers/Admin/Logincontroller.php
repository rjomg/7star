<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Logincontroller extends Controller
{
    //显示后台登录界面
    public function index() {
        return view("login.login");
    }
}
