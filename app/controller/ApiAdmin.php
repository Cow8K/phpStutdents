<?php

namespace app\controller;

use think\facade\Db;
use think\facade\Session;
use app\common\Result;
use app\common\ResultCode;

class ApiAdmin
{
    public function login()
    {
        $username = input("username");
        $password = input("password");

        // 参数校验
        if (empty($username) || empty($password)) {
            return Result::error('参数不能为空', ResultCode::PARAM_ERROR);
        }

        // 查询用户
        $user = Db::table('admin_user')
            ->where('username', $username)
            ->findOrEmpty();

        // 校验用户 & 密码
        if (empty($user) || !password_verify($password, $user['password'])) {
            return Result::error('用户名或密码错误', ResultCode::ERROR);
        }

        $userId = $user['id'];
        Db::table('admin_log')->insert([
            'remark' => "管理员 {$username} 登陆",
            'admin_id' => $userId,
        ]);

        Session::set('userInfo', [
            'id' => $userId,
            'username' => $username,
        ]);

        // 登录成功
        unset($user['password']);

        return Result::success($user, '登录成功');
    }

}