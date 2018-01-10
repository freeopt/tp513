<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/22
 * Time: 14:02
 */

namespace app\api\model;


class User extends BaseModel {

    public function address(){
        return $this->hasOne('UserAddress', 'user_id', 'id');
    }
}