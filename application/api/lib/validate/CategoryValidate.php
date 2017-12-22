<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/22
 * Time: 8:47
 */

namespace app\api\lib\validate;


class CategoryValidate extends BaseValidate {
    protected $rule = [
        'pid' => 'isNotNegativeInt'
    ];
    protected $message = [
        'pid' => 'pid只能是非负整数'
    ];
}