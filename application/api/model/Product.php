<?php

namespace app\api\model;

class Product extends BaseModel {

    protected $hidden = ['delete_time', 'update_time', 'create_time'];

    public function getMainImgUrlAttr($value, $data){
        return $this->imgUrl($value, $data);
    }

    //关联product_image
    public function pimg(){
        return $this->hasMany('ProductImage', 'product_id', 'id');
    }

    public function pproperty(){
        return $this->hasMany('ProductProperty', 'product_id', 'id');
    }

    //按分类id获取该分类下所有商品
    public static function getProductsByCID($cid){
        $result = self::where('category_id', '=', $cid )->select();
        return $result;
    }

    //获取商品详情
    public static function getProductDetail($id){
        $result = self::with([
            'pimg' => function($query){
                $query->with('imgs')->order('order','asc');
            }
        ])
            ->with(['pproperty'])
            ->find($id);
        return $result;
    }
}
