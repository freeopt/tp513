<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/13
 * Time: 1:38
 */

namespace app\api\controller\v1;


use app\api\lib\validate\IDMustBeInteger;
use app\api\lib\validate\isPositiveInteger;
use app\api\model\Banner as BannerModel;

class Banner{

    public function getBanner($id){
        (new IDMustBeInteger())->goCheck();
        $banner = BannerModel::getBannerByID($id);
        return 'Verification passed';
    }
}