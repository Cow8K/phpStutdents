<?php

namespace app\common;

class ResultCode
{
    /** 成功 */
    const SUCCESS = 0;

    /** 通用错误 */
    const ERROR = -1;

    /** 参数错误 */
    const PARAM_ERROR = 1001;

    /** 未登录 / 未认证 */
    const UNAUTHORIZED = 1002;

    /** 无权限 */
    const FORBIDDEN = 1003;

    /** 资源不存在 */
    const NOT_FOUND = 1004;

    /** 业务校验失败 */
    const BUSINESS_ERROR = 2001;

    /** 数据不存在 */
    const DATA_NOT_FOUND = 2002;

    /** 系统错误 */
    const SYSTEM_ERROR = 5000;
}