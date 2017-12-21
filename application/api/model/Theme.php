<?php

namespace app\api\model;

class Theme extends BaseModel {

    protected $hidden = ['delete_time', 'update_time','topic_img_id', 'head_img_id'];
    //关联模型
    public function topicImg(){
        return $this->belongsTo('image', 'topic_img_id', 'id');
    }
    public function headImg(){
        return $this->belongsTo('image', 'head_img_id', 'id');
    }
    public function products(){
        return $this->belongsToMany('product', 'theme_product', 'product_id', 'theme_id');
    }

    //查询单个主题
//    public static function getThemeByID($id){
//        $result = self::with(['topicImg', 'headImg'])->find($id);
//        return $result;
//    }
    //查询单个或多个主题
    public static function getThemesByIDs($ids){
        $result = self::with('topicImg,headImg')->select($ids);
        return $result;
    }

    //查询主题商品
    public static function getComplexOneByID($id){
        $result = self::with('products,topicImg,headImg')->order('id desc')->find($id);
        return $result;
    }
}
