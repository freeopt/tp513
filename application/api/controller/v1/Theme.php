<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/20
 * Time: 11:12
 */

namespace app\api\controller\v1;

use app\api\lib\exception\MissException;
use app\api\lib\validate\IDConllection;
use app\api\lib\validate\IDMustBeInteger;
use app\api\model\Theme as ThemeModel;


class Theme{

    public function getTheme($ids = ''){
        (new IDConllection())->goCheck();
        $themes = ThemeModel::getThemesByIDs($ids);
        if($themes->isEmpty()){
            throw new MissException();
        }
        return $themes;
    }

    public function getComplexOne($id){
        (new IDMustBeInteger())->goCheck();
        $theme = ThemeModel::getComplexOneByID($id);
        if(!$theme){
            throw new MissException();
        }
        return $theme;
    }
}