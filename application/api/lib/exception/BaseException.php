<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/13
 * Time: 1:45
 */

namespace app\api\lib\exception;

use think\Exception;
use Throwable;

class BaseException extends Exception {

    public $code = 400;
    public $msg  = '通用参数错误';
    public $errorCode = '10000';

    public function __construct($params = [])
    {
        if (!is_array($params)) {
            return;
        }else if(key_exists('msg', $params)) {
            $this->msg = $params['msg'];
        }
        if(key_exists('code', $params)) {
            $this->code = $params['code'];
        }
        if(key_exists('errorCode', $params)){
            $this->errorCode = $params['errorCode'];
        }
    }
}