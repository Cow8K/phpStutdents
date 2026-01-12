<?php

namespace app\controller\api;

use app\BaseController;
use app\model\Score;
use app\common\Result;
use app\Request;

class ApiScore extends BaseController
{
    public function list()
    {
        $where=[];
        $page = $this->request->param('page/d',1);
        $limit = $this->request->param('limit/d',10);
        $whereArr = $this->request->param('where/a',[]);

        if(!empty($whereArr)){
            if(!empty($whereArr["name"])){
                $where[] = ["stu.name",'like','%'.$whereArr["name"].'%'];
            }

            if(!empty($whereArr["course_id"])){
                $where[] = ["sco.course_id",'=',$whereArr["course_id"]];
            }

            if(!empty($whereArr["grade"])){
                $where[] = ["stc.grade",'=',$whereArr["grade"]];
            }
            if(!empty($whereArr["class"])){
                $where[] = ["stc.title",'=',$whereArr["class"]];
            }
        }


        $obj = Score::alias('sco')
            ->join('student stu', 'stu.id = sco.student_id')
            ->join('stu_class stc', 'stc.id = stu.stu_class_id')
            ->join('course cr', 'cr.id = sco.course_id')
            ->where($where);
        $objNew = clone $obj;

        $lists = $obj->field('sco.*,stu.name,cr.title,stc.title as class,stc.grade')
            ->page($page, $limit)
            ->order('sco.create_time', 'desc')
            ->select();

        $count = $objNew->count();
        return Result::page($lists, $count);
    }

    public function add()
    {
        $score = input("score");
        $courseId = input("courseId");
        $studentId = input("studentId");

        $res = Score::insert([
            'score' => $score,
            'course_id' => $courseId,
            'student_id' => $studentId,
        ]);

        return $res === 1 ? Result::success($res, '添加成功') : Result::error('添加失败');
    }

    public function delete()
    {
        $id = input('id');

        if (!$id) {
            return Result::error('参数错误');
        }

        $admin = Score::find($id);
        if (!$admin) {
            return Result::error('数据不存在');
        }

        $admin->delete();

        return Result::success(null, '删除成功');
    }

    public function update(Request $req)
    {
        $id = $req->param('id/d');
        $data = $req->only(['id', 'score', 'courseId', 'studentId']);

        if (!$id) {
            return Result::error('参数错误');
        }

        $score = Score::find($id);
        if (!$score) {
            return Result::error('数据不存在');
        }

        $score->score = $data['score'];
        $score->course_id = $data['courseId'];
        $score->student_id = $data['studentId'];

        $res = $score->save();
        return $res ? Result::success(null, '修改成功') : Result::error();
    }
}