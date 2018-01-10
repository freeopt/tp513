<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/24
 * Time: 19:21
 */

namespace app\api\service;


use app\api\lib\exception\TokenException;
use think\Cache;
use think\Exception;
use think\Request;

class Token{

    public static function generateToken(){
        $rankChars = getRandChars();
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        $salt      = config('secure.token_salt');

        return md5($rankChars.$timestamp.$salt);
    }

    public static function getCurrentUID(){
        $uid = self::getCurrentTokenVar('uid');
        return $uid;
    }

    public static function getCurrentTokenVar($key){
        //在http请求头header中获取token
        $token = Request::instance()->header('token');
        //读取缓存中的token数据
        $vars  = Cache::get($token);
        if(!$vars){
            throw new TokenException();
        }else if(!is_array($vars)){
            $vars = json_decode($vars, true);
        }
        if(array_key_exists($key, $vars)){
            return $vars[$key];
        }else{
            throw new Exception('尝试获取的Token变量不存在');
        }
    }
}