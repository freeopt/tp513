<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/13
 * Time: 9:51
 */

namespace app\api\lib\validate;


use app\api\lib\exception\BaseException;

class IDMustBeInteger extends BaseValidate {

    protected $rule = [
        'id' => 'require|isPositiveInt',
    ];

    protected function isPositiveInt( $value, $rule='', $data='', $field='' ){
        if( is_numeric($value) && is_int($value + 0) && ($value + 0) > 0 ){
            return true;
        }else{
            return $field.'必须是正整数..';
        }
    }
}