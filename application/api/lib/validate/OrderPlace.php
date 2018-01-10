<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2018/1/5
 * Time: 14:32
 */

namespace app\api\lib\validate;


use app\api\lib\exception\ParamException;

class OrderPlace extends BaseValidate {

//    protected $data = [
//        [
//            'product_id' => 1,
//            'count'      => 3
//        ],
//        [
//            'product_id' => 2,
//            'count'      => 3
//        ],
//        [
//            'product_id' => 3,
//            'count'      => 3
//        ]
//    ];

    protected $rule = [
        'data' => 'require|checkOrderProducts'
    ];
    protected $singleRule = [
        'product_id' => 'require|isPositiveInt',
        'count' => 'require|isPositiveInt'
    ];

    protected function checkOrderProducts($values){
        if(empty($values)){
            throw new ParamException([
                'msg' => '商品列表不能为空'
            ]);
        }
        if(!is_array($values)){
            throw new ParamException([
                'msg' => '商品参数不正确'
            ]);
        }
        foreach ($values as $v){
            $this->checkProduct($v);
        }
        return true;
    }

    private function checkProduct($value){
        $validate = new BaseValidate($this->singleRule);
        $result = $validate->check($value);
        if($result){
            return true;
        }else{
            throw new ParamException(['msg'=>'商品列表参数错误']);
        }
    }

}