<?php
declare (strict_types = 1);

namespace app\model;

use think\Model;

class Student extends Model
{
    protected $append = ['createTime', 'stuNumber', 'classId'];
    protected $hidden = ['create_time', 'stu_number', 'stu_class_id'];


    public function getCreateTimeAttr($value, $data)
    {
        return $data['create_time'] ?? null;
    }

    public function getStuNumberAttr($value, $data)
    {
        return $data['stu_number'] ?? null;
    }

    public function getClassIdAttr($value, $data)
    {
        return $data['stu_class_id'] ?? null;
    }
}
