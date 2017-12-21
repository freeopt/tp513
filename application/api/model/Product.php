<?php

namespace app\api\model;

class Product extends BaseModel {

    protected $hidden = ['delete_time', 'update_time', 'create_time'];

    public function getMainImgUrlAttr($value, $data){
        return $this->imgUrl($value, $data);
    }
}
