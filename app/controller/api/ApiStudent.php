<?php

namespace app\controller\api;

use app\BaseController;
use app\Request;
use think\facade\Db;
use app\common\Result;
use app\model\Student;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Throwable;

class ApiStudent extends BaseController
{
    public function addStudent(Request $req)
    {
        $name = input("name");
        $gender = input("gender");
        $birthday = input("birthday");
        $stuClassId = input("classId");

        $student = Db::name('student')->where('name', $name)->find();
        if (!empty($student)) {
            return Result::error("学生: {$name} 已存在");
        }

        $maxId = Db::name('student')->order('id', 'desc')->value('id');
        $maxId = empty($maxId) ? 1 : $maxId + 1;

        $res = Db::name('student')->insert([
            'name' => $name,
            'gender' => $gender,
            'stu_number' => date('Ymd') . sprintf('%04d', $maxId),
            'birthday' => $birthday,
            'stu_class_id' => $stuClassId,
        ]);

        return $res === 1 ? Result::success($res, '添加成功') : Result::error('添加成功');
    }

    public function deleteStudent()
    {
        $id = input('id');

        if (!$id) {
            return Result::error('参数错误');
        }

        $admin = Student::find($id);
        if (!$admin) {
            return Result::error('数据不存在');
        }

        $admin->delete();

        return Result::success(null, '删除成功');
    }

    public function updateStudent(Request $req)
    {
        $id = $req->param('id/d');
        $data = $req->only(['id', 'name', 'gender', 'birthday', 'classId']);

        if (!$id) {
            return Result::error('参数错误');
        }

        $student = Student::find($id);
        if (!$student) {
            return Result::error('数据不存在');
        }

        $student['name'] = $data['name'];
        $student['gender'] = $data['gender'];
        $student['birthday'] = $data['birthday'];
        $student['stu_class_id'] = $data['classId'];

        $res = $student->save();
        return $res ? Result::success(null, '修改成功') : Result::error();
    }

    public function studentList()
    {
        $page = input("page", 1);
        $limit = input("limit", 10);

        $res = Student::alias('stu')
            ->leftJoin('stu_class sc', 'stu.stu_class_id = sc.id')
            ->order('stu.id', 'desc')
            ->field('stu.*, sc.grade, sc.title')
            ->paginate([
                "list_rows" => $limit,
                "page"      => $page,
            ]);

        return Result::page($res->items(), $res->total());
    }

    private function readExcel($file, $dateTitle = [])
    {
        try {
            $allowType = [
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'application/vnd.ms-excel'
            ];

            if (!in_array($file["type"], $allowType)) {
                return Result::error("格式不允许");
            }

            $filePath = $file["tmp_name"];
            $reader = $file["type"] == $allowType[0] ? new Xlsx : new Xls;
            $excel = $reader->load($filePath);
            $sheet = $excel->getSheet(0);
            $allRow = $sheet->getHighestRow();
            $allColumn = $sheet->getHighestColumn();
            $allColumnNumber = Coordinate::columnIndexFromString($allColumn);

            $keys = [];
            $dataIndex = [];
            for ($i = 1; $i <= $allColumnNumber; $i++) {
                $value = $sheet->getCellByColumnAndRow($i, 1)->getValue();
                $keys[] = $value;

                if (in_array($value, $dateTitle)) {
                    $dataIndex[] = $i;
                }

            }

            $data = [];
            for ($j = 2; $j <= $allRow; $j++) {
                $values = [];
                for ($i = 1; $i <= $allColumnNumber; $i++) {
                    $value = $sheet->getCellByColumnAndRow($i, $j)->getValue();
                    if (in_array($i, $dataIndex)) {
                        // 处理成日期格式
                        $obj = Date::excelToDateTimeObject($value);
                        $value = $obj->format('Y-m-d');
                    }
                    $values[] = $value;
                }

                $data[] = array_combine($keys, $values);
            }

            return $data;
        } catch (Throwable $th) {
            return Result::error('导入错误：' . $th->getMessage());
        }
    }

    public function uploadExcel()
    {
        if (!isset($_FILES["file"]) || $_FILES["file"]["error"] != 0) {
            return Result::error('未找到文件');
        }

        $saveData = [];
        $file = $_FILES["file"];
        $data = $this->readExcel($file, ["生日"]);

        foreach ($data as $value) {
            $saveData[] = [
                "stu_number" => $value["学号"],
                "name" => $value["姓名"],
                "gender" => $value["性别"] == '男' ? 1 : 2,
                "birthday" => $value["生日"],
                "stu_class_id" => $value["班级ID"],
            ];
        }

        try {
            $result = Db::name('student')->insertAll($saveData);
        } catch (Throwable $th) {
            return Result::error('导入失败：' . $th->getMessage());
        }

        if ($result) {
            return Result::success($result, '导入成功');
        }
        return Result::error('导入失败');
    }
}