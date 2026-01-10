<?php
declare (strict_types = 1);

namespace app\middleware;

use app\common\Result;
use Closure;
use think\Request;
use think\facade\Session;

class Auth
{
    public function handle(Request $request, Closure $next)
    {
        $secondGrade = 2;
        $thirdGrade = 3;
        $secondAdmin = ["Student", "StuClazz", "ApiStuClazz", "ApiStudent"];
        $thirdAdmin = ["Student", "ApiStudent"];

        $action = $request->action();
        $controller = $request->controller();
        $shortName = substr(strrchr($controller, '.'), 1);
        $groupId = Session::get('userInfo')['groupId'];

        // 二级管理员：管理班级和学生，增删改查
        if ($groupId === $secondGrade && !in_array($shortName, $secondAdmin)) {
            return Result::error("无权限访问");
        }
        // 三级管理员：管理学生，不能删除
        else if ($groupId === $thirdGrade && (!in_array($shortName, $thirdAdmin) || $action === "deleteStudent")) {
            return Result::error("无权限访问");
        }

        return $next($request);
    }
}
