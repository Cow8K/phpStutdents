<?php
declare (strict_types = 1);

namespace app\middleware;

use think\Request;
use think\facade\Session;

class CheckLogin
{
    public function handle(Request $request, \Closure $next)
    {
        $userInfo = Session::get('userInfo');
        if (is_null($userInfo)) {
            return redirect('/admin/login');
        }

        return $next($request);
    }
}
