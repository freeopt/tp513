<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/13
 * Time: 1:39
 */

namespace app\api\model;


use think\Model;

class Banner extends Model {

    protected $hidden = ['id', 'update_time', 'delete_time'];

    public function items(){
        return $this->hasMany('BannerItem', 'banner_id', 'id');
    }

    public static function getBannerByID($id){
        $result = self::with(['items', 'items.img'])->find();
        return $result;
    }
}