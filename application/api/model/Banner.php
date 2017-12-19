<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/13
 * Time: 1:39
 */

namespace app\api\model;


use think\Db;
use think\Log;
use think\Model;

class Banner extends Model {

    public function items(){
        return $this->hasMany('BannerItem', 'banner_id', 'id');
    }

    public static function getBannerByID($id){
//        $result = Db::query('select * from banner_item where banner_id=?', [$id]);
//        $result = Db::table('banner_item')->where('banner_id', '=', $id)->select();
//        $result = Db::table('banner_item')->where(function($query) use ($id){
//            $query->where('banner_id', '=', $id);
//        })->select();

        $result = self::with(['items', 'items.img'])->find();
        return $result;
    }
}