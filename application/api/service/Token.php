<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/24
 * Time: 19:21
 */

namespace app\api\service;


class Token{

    public static function generateToken(){
        $rankChars = getRandChars();
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        $salt      = config('secure.token_salt');

        return md5($rankChars.$timestamp.$salt);
    }
}