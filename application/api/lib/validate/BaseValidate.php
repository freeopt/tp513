<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/13
 * Time: 9:48
 */

namespace app\api\lib\validate;


use think\Exception;
use think\Request;
use think\Validate;

class BaseValidate extends Validate {

    public function goCheck(){
        $data = Request::instance()->param();
        $result = $this->check($data);

        if($result){
            return true;
        }else{
            throw new Exception('ID必须是正整数...');
//            var_dump($this->error);
        }
    }
}