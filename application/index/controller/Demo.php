<?php
/**
 * Created by Thai Fintech.
 * User: Jessy Chan
 * Date: 2018/1/11
 * Time: 11:22
 */

namespace app\index\controller;


use think\Controller;

class Demo extends Controller {

    public function demo(){
        var_dump(date('m'), dechex(date('m')));
        echo '<hr>';
        var_dump(date('d'));
        echo '<hr>';
        var_dump(time(), substr(time(),-5));
        echo '<hr>';
        var_dump(microtime(), substr(microtime(),2,5));
        echo '<hr>';
        var_dump(sprintf('%02d', rand(0,99)));
    }
}