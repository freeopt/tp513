<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/13
 * Time: 1:45
 */

namespace app\api\lib\exception;

use think\Exception;

class BaseException extends Exception {

    public $code = 400;
    public $msg  = '通用参数错误';
    public $errorCode = '999';
}