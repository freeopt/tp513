<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/13
 * Time: 1:39
 */

namespace app\api\model;


use app\api\lib\exception\BannerMissException;
use think\Db;
use think\Exception;

class Banner{

    public static function getBannerByID($id){

        $result = Db::query('select * from banner_item where banner_id=?', [$id]);
        return $result;
    }
}