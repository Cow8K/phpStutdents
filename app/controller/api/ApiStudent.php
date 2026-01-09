<?php

namespace app\controller\api;

use app\Request;
use think\facade\Db;
use app\common\Result;
use app\model\Student;

class ApiStudent
{
    public function addStudent(Request $req)
    {
        $name = input("name");
        $gender = input("gender");
        $birthday = input("birthday");
        $stuClassId = input("classId");

        $student = Db::name('student')->where('name', $name)->find();
        if (!empty($student)) {
            return Result::error("学生: {$name} 已存在");
        }

        $maxId = Db::name('student')->order('id', 'desc')->value('id');
        $maxId = empty($maxId) ? 1 : $maxId + 1;

        $res = Db::name('student')->insert([
            'name' => $name,
            'gender' => $gender,
            'stu_number' => date('Ymd') . sprintf('%04d', $maxId),
            'birthday' => $birthday,
            'stu_class_id' => $stuClassId,
        ]);

        return $res === 1 ? Result::success($res, '添加成功') : Result::error('添加成功');
    }

    public function deleteStudent()
    {
        $id = input('id');

        if (!$id) {
            return Result::error('参数错误');
        }

        $admin = Student::find($id);
        if (!$admin) {
            return Result::error('数据不存在');
        }

        $admin->delete();

        return Result::success(null, '删除成功');
    }

    public function updateStudent(Request $req)
    {
        $id = $req->param('id/d');
        $data = $req->only(['id', 'name', 'gender', 'birthday', 'classId']);

        if (!$id) {
            return Result::error('参数错误');
        }

        $student = Student::find($id);
        if (!$student) {
            return Result::error('数据不存在');
        }

        $student['name'] = $data['name'];
        $student['gender'] = $data['gender'];
        $student['birthday'] = $data['birthday'];
        $student['stu_class_id'] = $data['classId'];

        $res = $student->save();
        return $res ? Result::success(null, '修改成功') : Result::error();
    }

    public function studentList()
    {
        $page = input("page", 1);
        $limit = input("limit", 10);

        $res = Student::alias('stu')
            ->leftJoin('stu_class sc', 'stu.stu_class_id = sc.id')
            ->order('stu.id', 'desc')
            ->field('stu.*, sc.grade, sc.title')
            ->paginate([
                "list_rows" => $limit,
                "page"      => $page,
            ]);

        return Result::page($res->items(), $res->total());
    }

}