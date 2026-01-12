<?php

namespace app\controller\web;

use app\BaseController;
use think\facade\Db;
use think\facade\Event;
use think\facade\Session;
use app\middleware\Auth;
use app\middleware\CheckLogin;
use app\model\Score;
use app\model\Student;
use app\model\StuClass;

class Admin extends BaseController
{
    protected $middleware = [
        Auth::class => ['except' => ['login', 'index', 'logout']],
        CheckLogin::class => ['except' => 'login'],
    ];

    public function index()
    {
        $scoreModel = new Score;
        $classModel = new StuClass;
        $studentModel = new Student;

        $studentCount = $studentModel->count();
        $studentClassCount = Student::alias('s')
            ->leftJoin('stu_class c', 's.stu_class_id = c.id')
            ->group('s.stu_class_id')
            ->field([
                'c.id',
                'c.title',
                'c.grade',
                'COUNT(s.id)' => 'count'
            ])
            ->select();

        $stuGradeCount = $studentModel->alias('stu')
            ->join('stu_class stc', 'stu.stu_class_id = stc.id')
            ->group('stc.grade')
            ->field('*,count(*) as count')
            ->select()
            ->visible(["count", "grade"]);


        $classCount = $classModel->count();
        $classGradeCount = $classModel->group('grade')->field('*,count(*) as count')->select();

        // 年级 班级 课程科目
        $scoreInfo = $scoreModel->alias('sc')
            ->join('student stu', 'sc.student_id = stu.id')
            ->join('stu_class stc', 'stc.id = stu.stu_class_id')
            ->join('course c', 'c.id = sc.course_id')
            ->field('sc.*,stc.grade,stc.title as class,c.title,max(sc.score) as max,min(sc.score) as min,avg(sc.score) as avg')
            ->group('stc.grade,stc.title,c.id')
            ->select()->visible(["class", "grade", "title", "max", "min", "avg"]);

        $data = [
            [
                "title" => "学生总数量",
                "count" => $studentCount,
                "children" => [$stuGradeCount->toArray(), $studentClassCount->toArray()]
            ],
            [
                "title" => "班级总数量",
                "count" => $classCount,
                "children" => [$classGradeCount->toArray()]
            ]
        ];


        $pageData = [
            'userInfo' => Session::get('userInfo'),
            'title' => '用户中心',
            'data' => $data,
            "scoreInfo" => json_encode($scoreInfo->toArray(), JSON_UNESCAPED_UNICODE),
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