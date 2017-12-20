<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2017/12/20
 * Time: 9:59
 */

namespace app\api\controller\v2;


class Banner{

    public function getBanner($id){
        return 'v2 - id='.$id;
    }
}