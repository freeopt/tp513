<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2018/1/4
 * Time: 11:42
 */

namespace app\api\lib\exception;


class ForbiddenException extends BaseException {
    public $code = 403;
    public $msg  = '权限不够';
    public $errorCode = 10001;
}