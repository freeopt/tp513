<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/25
 * Time: 11:30
 */

namespace app\api\model;


class ProductImage extends BaseModel {

        protected $hidden = ['delete_time', 'product_id'];

        public function imgs(){
            return $this->belongsTo('Image', 'img_id', 'id');
        }
}