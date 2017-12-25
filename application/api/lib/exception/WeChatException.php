<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/22
 * Time: 16:31
 */

namespace app\api\lib\exception;


class WeChatException extends BaseException {

    public $code = 400;
    public $msg  = '微信接口调用失败';
    public $errorCode = 999;
}