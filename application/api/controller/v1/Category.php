<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/22
 * Time: 8:39
 */

namespace app\api\controller\v1;


use app\api\lib\exception\MissException;
use app\api\lib\validate\CategoryValidate;
use app\api\model\Category as CategoryModel;

class Category{

    public function getCategory($pid = 0){
        (new CategoryValidate())->goCheck();
        $result = CategoryModel::with('img')->where('pid', '=', $pid)->select();
        if($result->isEmpty()){
            throw new MissException(['msg'=>'分类不存在']);
        }
        //临时隐藏字段
        $result = $result->hidden(['summary']);
        return $result;
    }
}