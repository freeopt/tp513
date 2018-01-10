<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/26
 * Time: 14:16
 */

namespace app\api\lib\validate;


class AddressCreate extends BaseValidate {

    protected $rule = [
        'name'     => 'require|isNotEmpty',
        'mobile'   => 'require',
        'city'     => 'require|isNotEmpty',
        'province' => 'require|isNotEmpty',
        'country'  => 'require|isNotEmpty',
        'detail'   => 'require|isNotEmpty'
    ];
}