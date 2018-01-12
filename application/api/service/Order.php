<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2018/1/9
 * Time: 10:27
 */

namespace app\api\service;

use app\api\controller\v1\BaseController;
use app\api\lib\exception\OrderException;
use app\api\lib\exception\UserException;
use app\api\model\OrderProduct;
use app\api\model\Product;
use app\api\model\UserAddress;
use think\Db;
use think\Exception;

class Order extends BaseController {

    protected $oProducts;   //订单商品列表
    protected $products;    //库存商品列表
    protected $uid;

    public function place($uid, $oPorducts){
        $this->uid       = $uid;
        $this->oProducts = $oPorducts;
        $this->products  = $this->getProductsByOrder();

        //检查订单库存
        $orderStatus = $this->getOrderStatus();
        if(!$orderStatus['pass']){
            $orderStatus['order_id'] = -1;
            return $orderStatus;
        }
        //创建订单快照
        $orderSnap = $this->snapOrder($orderStatus);

        //生成订单
        $order = $this->createOrder($orderSnap);
        $order['pass'] = true;
        return $order;
    }

    //创建订单
    private function createOrder($orderSnap){
        $orderNo = $this->makeOrderNo();

        $order = new \app\api\model\Order();
        Db::startTrans();
        try {
            //写入order表
            $order->order_no = $orderNo;
            $order->user_id = $this->uid;
            $order->total_price = $orderSnap['orderPrice'];
            $order->total_count = $orderSnap['totalCount'];
            $order->snap_img = $orderSnap['snapImg'];
            $order->snap_name = $orderSnap['snapName'];
            $order->snap_address = json_encode($orderSnap['snapAddress']);
            $order->snap_items = json_encode($orderSnap['pStatus']);
            $order->save();

            //写入order_product表
            $orderId = $order->id;
            foreach ($this->oProducts as &$v) {
                $v['order_id'] = $orderId;
            }
            $orderProduct = new OrderProduct();
            $orderProduct->saveAll($this->oProducts);
            Db::commit();
        }catch (Exception $e){
            Db::rollback();
            throw $e;
        }
        return [
            'order_id' => $orderId,
            'order_no' => $orderNo,
            'create_time' => $order->create_time
        ];
    }

    //随机生成订单编号
    private function makeOrderNo(){
        $yy = ['A','B','C','D','E','F','G','H','I','J','K'];
        $orderNo = $yy[intval(date('Y')) - 2018] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2,5) . sprintf('%02d', rand(0,99));
        return $orderNo;
    }

    //生成订单快照
    private function snapOrder($orderStatus){
        $snap = [
            'orderPrice' => 0,
            'totalCount' => 0,
            'snapAdress' => '',
            'snapName'   => '',
            'snapImg'    => '',
            'pStatus'    => []
        ];
        $snap['orderPrice'] = $orderStatus['orderPrice'];
        $snap['totalCount'] = $orderStatus['totalCount'];
        $snap['pStatus']    = $orderStatus['pStatus'];
        $snap['snapAddress'] = $this->getUserAdress();
        $snap['snapName']   = $this->products[0]['name'];
        $snap['snapImg']    = $this->products[0]['main_img_url'];

        return $snap;
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
            'totalCount' => 0,
            'pStatus'    => []
        ];
        //匹配订单商品库存
        foreach ($this->oProducts as $v){
            $status['totalCount'] += $v['count'];
            $pstatus = $this->getProductStatus($v['product_id'], $v['count']);
            if(!$pstatus['haveStock'])
                $status['pass'] = false;
            $status['orderPrice'] += $pstatus['totalPrice'];
            array_push($status['pStatus'], $pstatus);
        }
        return $status;
    }

    private function getUserAdress(){
        $userAdress = UserAddress::where('user_id', '=', $this->uid)->find();
        if(!$userAdress){
            throw new UserException([
                'msg' => '用户收货地址不存在,下单失败',
                'errorCode' => 60001
            ]);
        }
        return $userAdress->toArray();
    }

    //获取订单商品状态
    private function getProductStatus($opid, $count){
        $pstatus = [
            'id'         => null,
            'name'       => '',
            'haveStock'  => false,
            'count'      => 0,
            'totalPrice' => 0
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