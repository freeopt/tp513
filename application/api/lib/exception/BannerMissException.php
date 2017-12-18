<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/14
 * Time: 9:59
 */

namespace app\api\lib\exception;


class BannerMissException extends BaseException {

    public $code = 404;
    public $msg  = '请求的banner不存在';
    public $errorCode = '40000';
}