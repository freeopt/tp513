<?php

namespace app\api\model;

use think\Model;

class BaseModel extends Model{
    //通过模型读取器拼接URL
    protected function imgUrl($value, $data){
        $finalUrl = $value;
        if($data['from'] == 1){
            $finalUrl = config('setting.img_prefix').$value;
        }
        return $finalUrl;
    }
}
