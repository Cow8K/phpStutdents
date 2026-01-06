<?php

namespace app\controller;

use app\Request;
use think\facade\Db;
use think\facade\Session;
use think\exception\ValidateException;
use app\model\Admin as AdminModel;
use app\validate\Admin as AdminValidate;
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
            validate(AdminValidate::class)->check($req->param());
        }
        catch (ValidateException $e) {
            return Result::error($e->getError());
        }

        // 判断用户是否存在
        $user = AdminModel::where('username', $username)->find();
        if (!empty($user)) {
            return Result::error("用户 {$username} 已存在");
        }

        // 加密密码
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // 入库
        $res = AdminModel::insert([
            'username' => $username,
            'password' => $hash,
            'group_id' => $groupId,
        ]);

        return $res === 1 ? Result::success($res, '注册成功') : Result::error('注册失败');
    }

    public function adminList()
    {
        $db = new AdminModel();
        $where = [];
        $page = input("page", 1);
        $limit = input("limit", 10);

        $adminList = $db->where($where)
            ->field(['id, username, group_id, score, create_time'])
            ->order('create_time desc')
            ->page($page, $limit)
            ->select();

        $count = $db->where($where)->count();

        return Result::page($adminList, $count);
    }

}