<?php

namespace app\api\model;

class Product extends BaseModel {

    protected $hidden = ['delete_time', 'update_time', 'create_time'];

    public function getMainImgUrlAttr($value, $data){
        return $this->imgUrl($value, $data);
    }

    //按分类id获取该分类下所有商品
    public static function getProductsByCID($cid){
        $result = self::where('category_id', '=', $cid )->select();
        return $result;
    }
}
