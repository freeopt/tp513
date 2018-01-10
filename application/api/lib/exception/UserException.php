<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/27
 * Time: 15:26
 */

namespace app\api\lib\exception;


class UserException extends BaseException {

    public $code      = 404;
    public $msg       = '用户不存在';
    public $errorCode = 60000;
}