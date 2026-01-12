<?php

namespace app\controller\web;

use app\BaseController;
use think\facade\Db;

class Score extends BaseController
{
    public function scoreManage()
    {
        $stuList = Db::name('student')->field('id,name')->select();
        $courseList = Db::name('course')->field('id,title')->select();
        $gradeList = Db::name('stu_class')->distinct()->column('grade');
        $classList = Db::name('stu_class')->distinct()->column('title');

        $pageData = [
            "stuList" => $stuList,
            "courseList" => $courseList,
            "gradeList" => $this->sortList($gradeList),
            "classList" => $this->sortList($classList),
            "title" => "成绩管理"
        ];
        return view('score/score_manage', $pageData);
    }

    private function sortList($arr): array
    {
        $newArr = [];
        foreach ($arr as $value) {
            $first = mb_substr($value,0,1);
            switch ($first) {
                case '一':
                    $name = 1;
                    break;
                case '二':
                    $name = 2;
                    break;
                case '三':
                    $name = 3;
                    break;
                case '四':
                    $name = 4;
                    break;
                case '五':
                    $name = 5;
                    break;
                case '六':
                    $name = 6;
                    break;
                default:
                    $name = 0;
                    break;
            }
            $newArr[$name] = $value;
        }
        ksort($newArr);
        return $newArr;
    }
}