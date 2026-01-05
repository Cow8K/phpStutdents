<?php

namespace app\controller;

use app\Request;
use think\facade\Db;
use think\facade\Session;
use think\exception\ValidateException;
use app\validate\Admin;
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
        $user = Db::table('admin')
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

    public function addAdmin(Request $req)
    {
        $username = input("username");
        $password = input("password");
        $groupId = input("groupId");

        try {
            validate(Admin::class)->check($req->param());
        }
        catch (ValidateException $e) {
            return Result::error($e->getError());
        }

        // 判断用户是否存在
        $user = Db::table('admin')->where('username', $username)->findOrEmpty();
        if (!empty($user)) {
            return Result::error("用户 {$username} 已存在");
        }

        // 加密密码
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // 入库
        $res = Db::table('admin')->insert([
            'username' => $username,
            'password' => $hash,
            'group_id' => $groupId,
        ]);

        return $res === 1 ? Result::success($res, '注册成功') : Result::error('注册失败');
    }

}