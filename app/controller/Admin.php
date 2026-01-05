<?php

namespace app\controller;

use app\BaseController;
use think\facade\Session;

class Admin extends BaseController
{
    public function index()
    {
        $userInfo = Session::get('userInfo');
        if (is_null($userInfo)) {
            return '请先登录';
        }

        return "Admin index";
    }

    public function login()
    {
        return view();
    }
}