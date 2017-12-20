<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/20
 * Time: 14:11
 */

namespace app\api\lib\validate;


class IDConllection extends BaseValidate {

    protected $rule = [
        'ids' => 'require|checkIDs'
    ];
    protected $message = [
        'ids' => 'id必须是以逗号分隔的正整数'
    ];
}