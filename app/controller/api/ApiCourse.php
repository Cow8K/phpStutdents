<?php

namespace app\controller\api;

use app\BaseController;
use app\common\Result;
use app\model\Course;
use app\Request;

class ApiCourse extends BaseController
{
    public function list()
    {
        $page = $this->request->param('page/d',1);
        $limit = $this->request->param('limit/d',10);
        $where=[];

        $whereArr = $this->request->param('where/a',[]);
        if(!empty($whereArr)){
            foreach ($whereArr as $key => $value) {
                if(!empty($value)){
                    $where[] = [$key,'=',$value];
                }
            }
        }

        $lists = Course::where( $where)->page($page,$limit)->order('create_time','desc')->select();
        $count = Course::where($where)->count();
        return Result::page($lists, $count);
    }

    public function add()
    {
        $title = input("title");

        $res = Course::insert(['title' => $title]);

        return $res === 1 ? Result::success($res, '添加成功') : Result::error('添加失败');
    }

    public function delete()
    {
        $id = input('id');

        if (!$id) {
            return Result::error('参数错误');
        }

        $course = Course::find($id);
        if (!$course) {
            return Result::error('数据不存在');
        }

        $course->delete();

        return Result::success(null, '删除成功');
    }

    public function update(Request $req)
    {
        $id = $req->param('id/d');
        $data = $req->only(['id', 'title']);

        if (!$id) {
            return Result::error('参数错误');
        }

        $course = Course::find($id);
        if (!$course) {
            return Result::error('数据不存在');
        }

        $course->title = $data['title'];

        $res = $course->save();
        return $res ? Result::success(null, '修改成功') : Result::error();
    }
}