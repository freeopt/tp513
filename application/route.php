<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

Route::get('demo', 'index/Demo/demo');
Route::get('api/:version/banner/:id', 'api/:version.Banner/getBanner');

//Route::get('api/:version/theme/:id', 'api/:version.Theme/getTheme');
Route::get('api/:version/theme', 'api/:version.Theme/getTheme');
Route::get('api/:version/theme/:id', 'api/:version.Theme/getComplexOne');

//Route::get('api/:version/product/:id', 'api/:version.Product/getProductOne');
Route::get('api/:version/product/:id', 'api/:version.product/getOne',[],['id'=>'\d+']);
Route::get('api/:version/product/np_list', 'api/:version.Product/getProductList');
Route::get('api/:version/product/cp_list', 'api/:version.Product/getProductInCategory');

Route::get('api/:version/category', 'api/:version.Category.getCategory');

Route::post('api/:version/token/user', 'api/:version.Token/getToken');

Route::post('api/:version/address', 'api/:version.Address/createOrUpdateAddress');
Route::post('api/:version/test', 'api/:version.Address/test');

Route::post('api/:version/order', 'api/:version.Order/placeOrder');
