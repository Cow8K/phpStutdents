<?php

namespace app\controller\web;

use app\BaseController;

class Course extends BaseController
{

    public function courseManage()
    {
        return view('course/course_manage', ["title" => "课程管理"]);
    }
}