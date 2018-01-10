<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2018/1/9
 * Time: 14:26
 */

namespace app\api\lib\exception;


class OrderException extends BaseException {

    public $code      = 404;
    public $msg       = '订单不存在,请检查ID';
    public $errorCode = 80000;
}