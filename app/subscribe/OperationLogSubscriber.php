<?php
declare (strict_types = 1);

namespace app\subscribe;

use think\facade\Db;

class OperationLogSubscriber
{
    private function log($msg, $data)
    {
        Db::table('admin_log')->insert([
            'remark' => $msg,
            'admin_id' => $data['id'],
        ]);
    }

    public function onLogin($data)
    {
        $this->log("管理员 ${data['username']} 登录", $data);
    }

    public function onLogout($data)
    {
        $this->log("管理员 ${data['username']} 退出", $data);
    }
}
