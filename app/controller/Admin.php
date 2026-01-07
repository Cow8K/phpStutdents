<?php

namespace app\controller;

use app\BaseController;
use think\App;
use think\facade\Db;
use think\facade\View;
use think\facade\Request;
use think\facade\Session;

class Admin extends BaseController
{
    public function __construct(App $app)
    {
        parent::__construct($app);

        $menus = [
            "/admin/index" => "用户管理",
            "/admin/adminManage" => "管理员管理"
        ];

        $actionName = '/' . Request::controller(true) . '/' . Request::action();

        View::assign([
            "menus" => $menus,
            "actionName" => $actionName
        ]);
    }

    public function index()
    {
        $userInfo = Session::get('userInfo');
        if (is_null($userInfo)) {
            return '请先登录';
        }

        $pageData = [
            'userInfo' => $userInfo,
            'title' => '用户中心'
        ];

        return view('user_center', $pageData);
    }

    public function adminManage()
    {
        $adminGroups = Db::table('admin_group')->where('name', '!=', '超级管理员')->select();

        $pageData = [
            'adminGroups' => $adminGroups,
            'title' => '管理员管理'
        ];

        return view('admin_manage', $pageData);
    }

    public function login()
    {
        return view();
    }
}