<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/28
 * Time: 11:32
 */

namespace app\api\controller\v1;


use app\api\lib\validate\OrderPlace;
use app\api\service\UserToken;
use app\api\service\Order as OrderService;

class Order extends BaseController {

    protected $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'placeOrder']
    ];

    /**
     * @url     /order
     * @http    POST
     * 1.API接收到提交的订单信息后,检查商品库存
     * 2.库存检测通过,将订单信息写入数据库,提示客户端可以支付
     * 3.调用我们的支付接口,进行支付
     * 4.客户端发起支付后,再次检测库存
     * 5.库存检测通过,服务器调用微信的支付接口进行支付
     * 6.此时微信同步返回客户端支付结果,异步将支付结果返回我们的服务器
     * 7.支付成功后再次检查库存,减库存
     */
    public function placeOrder(){
        $validate = new OrderPlace();
        $result = $validate->goCheck();
        $products = input('post.data/a');
        $uid = UserToken::getCurrentUID();

        //检查商品库存数量,生成订单
        $order = new OrderService();
        $orderStatus = $order->place($uid, $products);
        return $orderStatus;
    }
}