<?php

namespace app\controller;

use app\BaseController;
use think\facade\Db;
use think\facade\Session;

class Admin extends BaseController
{
    public function index()
    {
        $userInfo = Session::get('userInfo');
        if (is_null($userInfo)) {
            return '请先登录';
        }

        $pageData = [
            'userInfo' => $userInfo,
            'active' => 1
        ];

        return view('user_center', $pageData);
    }

    public function adminManage()
    {
        $adminGroups = Db::table('admin_group')->where('name', '!=', '超级管理员')->select();

        $pageData = [
            'active' => 2,
            'adminGroups' => $adminGroups
        ];

        return view('admin_manage', $pageData);
    }

    public function login()
    {
        return view();
    }
}