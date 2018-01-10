<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/21
 * Time: 10:51
 */

namespace app\api\controller\v1;

use app\api\lib\exception\MissException;
use app\api\lib\validate\Count;
use app\api\lib\validate\CountValidate;
use app\api\lib\validate\IDMustBeInteger;
use app\api\model\Product as ProductModel;

class product{

    public function getProductOne($id){
        (new IDMustBeInteger())->goCheck();
        $product = ProductModel::find($id);
        if(!$product){
            throw new MissException();
        }
        return $product;
    }

    //获取新品列表
    public function getProductList($count = 10){
        (new CountValidate())->goCheck();
        $list = ProductModel::order('id desc')->limit($count)->select();
        if($list->isEmpty()){
            throw new MissException();
        }
        //临时隐藏字段
        $list = $list->hidden(['summary']);
        return $list;
    }

    //获取分类商品
    public function getProductInCategory($id = ''){
        (new IDMustBeInteger())->goCheck();
        $result = ProductModel::getProductsByCID($id);
        if($result->isEmpty()){
            throw new MissException(['msg' => '该分类下无商品']);
        }
        $result = $result->hidden(['summary']);
        return $result;
    }

    //获取商品详情
    public function getOne($id){
        (new IDMustBeInteger())->goCheck();
        $result = ProductModel::getProductDetail($id);
        if(!$result){
            throw new MissException(['msg' => '商品不存在']);
        }
        return $result;
    }
}