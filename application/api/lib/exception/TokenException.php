<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/27
 * Time: 15:02
 */

namespace app\api\lib\exception;


class TokenException extends BaseException {

    public $code      = 401;
    public $msg       = 'Token无效或已过期';
    public $errorCode = 10001;
}