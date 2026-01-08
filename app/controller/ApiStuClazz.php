<?php

namespace app\controller;

use app\Request;
use think\facade\Db;
use app\common\Result;

class apiStuClazz
{
    public function addClazz(Request $req)
    {
        $title = input("title");
        $grade = input("grade");

        $clazz = Db::name('stu_class')->where('title', $title)->find();
        if (!empty($clazz)) {
            return Result::error("班级: {$title} 已存在");
        }

        $res = Db::name('stu_class')->insert([
            'title' => $title,
            'grade' => $grade,
        ]);

        return $res === 1 ? Result::success($res, '添加成功') : Result::error('添加成功');
    }

    public function deleteClass()
    {
        $id = input('id');

        if (!$id) {
            return Result::error('参数错误');
        }

        $clazz = Db::name('stu_class')->where('id', $id)->find();
        if (!$clazz) {
            return Result::error('数据不存在');
        }

        Db::name('stu_class')->where('id', $id)->delete();

        return Result::success(null, '删除成功');
    }

    public function updateClazz(Request $req)
    {
        $id = $req->param('id/d');
        $data = $req->only(['id', 'title', 'grade']);

        if (!$id) {
            return Result::error('参数错误');
        }

        $clazz = Db::name('stu_class')->where('id', $id)->find();
        if (!$clazz) {
            return Result::error('数据不存在');
        }

        $res = Db::name('stu_class')->where('id', $id)->update([
            'id' => $id,
            'title' => $data['title'],
            'grade' => $data['grade'],
        ]);

        return $res ? Result::success(null, '修改成功') : Result::error();
    }

    public function clazzList()
    {
        $where = [];
        $page = input("page", 1);
        $limit = input("limit", 10);

        $clazzList = Db::name('stu_class')->where($where)
            ->field(['id, title, grade, create_time as createTime'])
            ->order('create_time desc')
            ->page($page, $limit)
            ->select();

        $count = Db::name('stu_class')->where($where)->count();

        return Result::page($clazzList, $count);
    }

}