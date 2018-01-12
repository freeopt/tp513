<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/27
 * Time: 13:16
 */

namespace app\api\model;


class UserAddress extends BaseModel {

    protected $hidden = ['add_time', 'delete_time', 'user_id'];
}