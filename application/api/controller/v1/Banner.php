<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/13
 * Time: 1:38
 */

namespace app\api\controller\v1;


use app\api\lib\exception\BannerMissException;
use app\api\lib\validate\IDMustBeInteger;
use app\api\lib\validate\isPositiveInteger;
use app\api\model\Banner as BannerModel;
use think\Model;

class Banner extends Model {

    /**
     * @param $id
     * @return null
     * @throws BannerMissException
     */
    public function getBanner($id){
        (new IDMustBeInteger())->goCheck();

        $banner = BannerModel::getBannerByID($id);
        if(!$banner){
            throw new BannerMissException();
        }
        return $banner;
    }
}