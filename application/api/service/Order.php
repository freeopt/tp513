<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2018/1/9
 * Time: 10:27
 */

namespace app\api\service;

use app\api\lib\exception\OrderException;
use app\api\model\Product;

class Order{

    protected $oProducts;   //订单商品列表
    protected $products;    //库存商品列表
    protected $uid;

    public function place($uid, $oPorducts){
        $this->uid       = $uid;
        $this->oProducts = $oPorducts;
        $this->products  = $this->getProductsByOrder();

        //检查订单库存
        $orderStatus = $this->getOrderStatus();
        return $orderStatus;
    }

    //根据订单信息查找库存商品信息
    private function getProductsByOrder(){
        $opids = [];
        foreach ($this->oProducts as $v){
            $opids[] = $v['product_id'];
        }
        $result = Product::select($opids)->visible(['id', 'name', 'stock', 'price', 'main_img_url'])->toArray();
        return $result;
    }

    //获取订单状态
    private function getOrderStatus(){
        $status = [
            'pass'       => true,
            'orderPrice' => 0,
            'pStatus'    => []
        ];
        //匹配订单商品库存
        foreach ($this->oProducts as $v){
            $pstatus = $this->getProductStatus($v['product_id'], $v['count']);

            if(!$pstatus['haveStock'])
                $status['pass'] = false;
            $status['orderPrice'] += $pstatus['totalPrice'];
            array_push($status['pStatus'], $pstatus);
        }
        return $status;
    }
    //获取订单商品状态
    private function getProductStatus($opid, $count){
        $pstatus = [
            'id' => null,
            'name' => '',
            'haveStock' => false,
            'count' => 0,
            'totalPrice' => 0,
        ];
        $index = -1;
        $length = count($this->products);
        for($i=0; $i<$length; $i++){
            if( $opid == $this->products[$i]['id'] ){
                $index = $i;
            }
        }
        if($index == -1){
            throw new OrderException(['msg' => 'id为'.$opid.'的商品不存在,创建订单失败']);
        }
        $pstatus['id']         = $opid;
        $pstatus['name']       = $this->products[$index]['name'];
        $pstatus['count']      = $count;
        $pstatus['totalPrice'] = $this->products[$index]['price'] * $count;

        if( ( $this->products[$index]['stock'] - $count ) >= 0 )
            $pstatus['haveStock'] = true;

        return $pstatus;
    }
}