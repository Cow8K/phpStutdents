<?php

namespace app\common;

class Result
{
    public static function success($data = null, string $msg = 'success', int $code = 0)
    {
        return json([
            'code' => $code,
            'msg'  => $msg,
            'data' => $data,
        ]);
    }

    public static function error(string $msg = 'error', int $code = -1, $data = null)
    {
        return json([
            'code' => $code,
            'msg'  => $msg,
            'data' => $data,
        ]);
    }

    public static function page($data = null, $count = null, string $msg = 'success', int $code = 0)
    {
        return json([
            'code' => $code,
            'count' => $count,
            'msg'  => $msg,
            'data' => $data,
        ]);
    }
}
