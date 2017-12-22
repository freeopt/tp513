<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/22
 * Time: 8:38
 */

namespace app\api\model;


class Category extends BaseModel {

    protected $hidden = ['pid', 'topic_img_id', 'delete_time', 'update_time'];

    public function img(){
        return $this->belongsTo('image', 'topic_img_id', 'id');
    }
}