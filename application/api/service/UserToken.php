<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/22
 * Time: 13:55
 */

namespace app\api\service;


use app\api\lib\enum\ScopeEnum;
use app\api\lib\exception\WeChatException;
use think\Exception;
use app\api\model\User as UserModel;

class UserToken extends Token {

    protected $code;
    protected $wxAppID;
    protected $wxAppSecret;
    protected $wxLoginUrl;

    public function __construct($code){
        $this->code        = $code;
        $this->wxAppID     = config('wechat.app_id');
        $this->wxAppSecret = config('wechat.app_secret');
        $this->wxLoginUrl  = sprintf(config('wechat.login_url'), $this->wxAppID, $this->wxAppSecret, $code);
    }

    public function get(){
        $result = curl_get($this->wxLoginUrl);
        $result = json_decode($result, true);
        if(empty($result)){
            throw new Exception('获取session_key及openID异常,微信内部错误');
        }else{
            $loginFail = array_key_exists('errcode', $result);
            if($loginFail){
                $this->processLoginError($result);
            }else{
                //通过验证,颁发令牌
                return $this->grantToken($result);
            }
        }
    }

    private function grantToken($result){
        //获取openid
        //查询数据库判断此openid是否已经存在
        //如果存在 则不处理,如果不存在 则新增一条user记录
        //生成Token令牌,准备缓存数据,写入缓存
        //将Token返回客户端
        //key: token令牌
        //value: 微信返回的结果集result, uid, scope

        $openid = $result['openid'];     //从微信返回的结果集中获取openid
        $user    = UserModel::where('openid', '=', $openid)->find();
        if($user){
            $uid = $user->id;
        }else{
            $uid = UserModel::create(['openid' => $openid]);
        }
        //准备缓存数据
        $cacheValue = $this->prepareCachedValue($result, $uid);
        //写入缓存
        $token = $this->saveCache($cacheValue);
        return $token;
    }

    private function saveCache($cacheValue){
        $key       = self::generateToken();
        $value     = json_encode($cacheValue);
        $expire_in = config('setting.token_expire_in');
        //写入缓存
        $result = cache($key, $value, $expire_in);
        return $key;
    }

    private function prepareCachedValue($result, $uid){
        $cacheValue          = $result;
        $cacheValue['uid']   = $uid;
        $cacheValue['scope'] = ScopeEnum::User;
//        $cacheValue['scope'] = 15;
        return $cacheValue;
    }

    private function newUser($openid){
        $user = UserModel::create([
            'openid' => $openid
        ]);
        return $user->id;
    }

    //返回微信接口错误信息
    private function processLoginError($result){
        throw new WeChatException([
            'msg'       => $result['errmsg'],
            'errorCode' => $result['errcode']
        ]);
    }
}