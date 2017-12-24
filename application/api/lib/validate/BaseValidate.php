<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/13
 * Time: 9:48
 */

namespace app\api\lib\validate;


use app\api\lib\exception\ParamException;
use think\Request;
use think\Validate;

class BaseValidate extends Validate {

    public function goCheck(){
        $data = Request::instance()->param();

        $result = $this->check($data);
        if($result){
            return true;
        }else{
            throw new ParamException([
                'msg' => $this->error
            ]);
        }
    }

    //验证ID是否为正整数
    protected function isPositiveInt( $value, $rule='', $data='', $field='' ){
        if( is_numeric($value) && is_int($value + 0) && ($value + 0) > 0 ){
            return true;
        }else{
            return false;
        }
    }

    //验证ID是非负整数
    protected function isNotNegativeInt($value){
        if(is_numeric($value) && is_int($value + 0) && ($value + 0) >= 0){
            return true;
        }
        return false;
    }

    //验证code不能为空
    protected function isNotEmpty($value){
        if(empty($value)){
            return false;
        }
        return true;
    }

    //验证IDS是否为逗号分隔的正整数集合
    protected function checkIDs($value){
        $values = explode(',', $value);

        if(empty($values)){
            return false;
        }
        foreach ($values as $id) {
            if(!$this->isPositiveInt($id)){
                return false;
            }
        }
        return true;
    }
}