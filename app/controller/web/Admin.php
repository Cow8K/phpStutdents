<?php

namespace app\controller\web;

use app\BaseController;
use think\facade\Db;
use think\facade\Event;
use think\facade\Session;
use app\middleware\CheckLogin;

class Admin extends BaseController
{
    protected $middleware = [
        CheckLogin::class => ['except' => 'login']
    ];

    public function index()
    {
        $pageData = [
            'userInfo' => Session::get('userInfo'),
            'title' => '用户中心'
        ];

        return view('admin\user_center', $pageData);
    }

    public function adminManage()
    {
        $adminGroups = Db::table('admin_group')->where('name', '!=', '超级管理员')->select();

        $pageData = [
            'adminGroups' => $adminGroups,
            'title' => '管理员管理'
        ];

        return view('admin\admin_manage', $pageData);
    }

    public function login()
    {
        $redirectUrl = request()->get('redirectUrl', './index');
        return view('admin\login', ['redirectUrl' => $redirectUrl]);
    }

    public function logout()
    {
        Event::trigger("Logout", Session::get('userInfo'));
        Session::delete('userInfo');

        $refer = request()->header()["referer"];
        $redirectUrl = str_replace(request()->domain(), "", $refer);

        return redirect((string)url("/admin/login", ["redirectUrl" => $redirectUrl]));
    }
}