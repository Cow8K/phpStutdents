<?php

namespace app\controller\web;

use app\BaseController;
use think\facade\Db;

class Student extends BaseController
{
    public function studentManage()
    {
        $classList = Db::name('stu_class')->order('create_time desc')->select();

        $pageData = [
            'title' => '学生管理',
            'classList' => $classList,
        ];

        return view('student/student_manage', $pageData);
    }
}