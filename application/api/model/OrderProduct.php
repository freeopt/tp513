<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2018/1/11
 * Time: 15:29
 */

namespace app\api\model;


use think\Model;

class OrderProduct extends Model {

    protected $hidden = ['delete_time', 'update_time'];
}