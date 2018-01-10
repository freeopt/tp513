<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2018/1/5
 * Time: 11:42
 */

namespace app\api\controller\v1;

use app\api\lib\enum\ScopeEnum;
use app\api\lib\exception\ForbiddenException;
use app\api\lib\exception\TokenException;
use app\api\Service\Token as ServiceToken;
use think\Controller;

class BaseController extends Controller{

    //普通用户和管理员权限前置
    protected function checkPrimaryScope(){
        $scope = ServiceToken::getCurrentTokenVar('scope');
        if($scope){
            if($scope >= ScopeEnum::User){
                return;
            }else{
                throw new ForbiddenException();
            }
        }else{
            throw new TokenException();
        }
    }
    //仅普通用户权限前置
    protected function checkExclusiveScope(){
        $scope = ServiceToken::getCurrentTokenVar('scope');
        if($scope){
            if($scope == ScopeEnum::User){
                return true;
            }else{
                throw new ForbiddenException();
            }
        }else{
            throw new TokenException();
        }
    }
}