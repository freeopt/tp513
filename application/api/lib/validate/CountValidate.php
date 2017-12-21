<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/21
 * Time: 16:06
 */

namespace app\api\lib\validate;


class CountValidate extends BaseValidate {

    protected $rule = [
        'count' => 'between:1,20|isPositiveInt'
    ];
    protected $message = [
        'count' => '数量只能是1-20之间的正整数'
    ];
}