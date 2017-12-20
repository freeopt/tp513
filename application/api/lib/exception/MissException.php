<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/20
 * Time: 15:25
 */

namespace app\api\lib\exception;



class MissException extends BaseException {

    public $code = 404;
    public $msg  = '请求的theme不存在';
    public $errorCode = 10003;
}