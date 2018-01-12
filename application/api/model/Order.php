<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2018/1/11
 * Time: 13:55
 */

namespace app\api\model;


use think\Model;

class Order extends Model {

    protected $hidden = ['add_time', 'delete_time', 'update_time'];
    protected $autoWriteTimestamp = true;
}