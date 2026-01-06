<?php
declare (strict_types = 1);

namespace app\model;

use think\Model;


class Admin extends Model
{
    protected $append = ['createTime', 'groupId'];
    protected $hidden = ['create_time', 'group_id'];


    public function getCreateTimeAttr($value, $data)
    {
        return $data['create_time'] ?? null;
    }

    public function getGroupIdAttr($value, $data)
    {
        return $data['group_id'] ?? null;
    }
}
