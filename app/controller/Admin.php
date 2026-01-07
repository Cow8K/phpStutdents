<?php

namespace app\controller;

use app\BaseController;
use think\App;
use think\facade\Db;
use think\facade\View;
use think\facade\Request;
use think\facade\Session;
use app\middleware\CheckLogin;

class Admin extends BaseController
{
    protected $middleware = [
        CheckLogin::class => ['except' => 'login']
    ];
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
        $pageData = [
            'userInfo' => Session::get('userInfo'),
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