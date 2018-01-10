<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/26
 * Time: 14:05
 */

namespace app\api\controller\v1;


use app\api\lib\exception\SuccessMessage;
use app\api\lib\exception\UserException;
use app\api\lib\validate\AddressCreate;
use app\api\model\User;
use app\api\model\User as UserModel;
use app\api\service\Token as TokenService;

class Address extends BaseController {

    //定义前置方法
    protected $beforeActionList = [
        'checkPrimaryScope' => ['only' => 'createOrUpdateAddress']
//        'first' => ['only' => 'test']
    ];

    public function test(){
        echo 'test<br>';
    }

    /**
     * @url /Address
     * @http POST
     */
    public function createOrUpdateAddress(){
        $validate = new AddressCreate();
        $validate->goCheck();

        //1.根据token来获取uid
        //2.根据uid查找用户数据,判断用户是否存在
        //3.获取用户从客户端提交的地址信息
        //4.根据用户地址信息是否存在,判断执行新增或更新操作
        $uid = TokenService::getCurrentUID();
        $user = UserModel::get($uid);
        if(!$user){
            throw new UserException();
        }
        $data = $validate->getDataByRule(input('post.'));

        $userAddress = $user->address;
        if($userAddress){
            //如果用户地址存在,执行更新操作
            $user->address->save($data);
        }else{
            //如果用户地址不存在,执行添加操作
            $user->address()->save($data);
        }
        $result = new SuccessMessage();
        return json($result, 201);
    }
}