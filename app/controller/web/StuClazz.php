<?php

namespace app\controller\web;

use app\BaseController;

class StuClazz extends BaseController
{
    public function clazzManage()
    {
        $classList = ["一年级", "二年级", "三年级", "四年级", "五年级", "六年级",];

        $pageData = [
            'classList' => $classList,
            'title' => '班级管理'
        ];

        return view('stu_clazz/clazz_manage', $pageData);
    }
}