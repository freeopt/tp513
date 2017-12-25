<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/22
 * Time: 11:55
 */

namespace app\api\controller\v1;


use app\api\lib\validate\TonkenGet;
use app\api\service\UserToken;

class Token{

    public function getToken($code = ''){
        (new TonkenGet())->goCheck();
        $ut = new UserToken($code);
        $token = $ut->get();
        return ['token' => $token];
    }
}