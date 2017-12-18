<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/14
 * Time: 20:40
 */

namespace app\api\lib\exception;


class ParamException extends BaseException {

    public $code      = 400;
    public $msg       = '参数错误';
    public $errorCode = 10002;
}