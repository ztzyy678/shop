<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// 网站首页
Route::get('/', function () {
    return view('home.index.index');
});

//前台路由

// 登录			hzh
Route::resource('home/login','Home\LoginController');

// 注册			hzh
Route::resource('home/register','Home\RegisterController');




// 后台路由

// 后台首页
Route::get('admin/index', function () {
   return view('Admin.index');
});


//后台登录 hzh
Route::get('admin/login','Admin\LoginController@login');
Route::get('admin/dologin','Admin\LoginController@dologin');

// 后台商品管理 hzh
Route::resource('admin/goods','Admin\GoodsController');

// 后台友情链接管理 hzh
Route::resource('admin/link','Admin\LinkController');
//后台品牌管理 hzh
Route::resource('admin/brand','Admin\BrandController');

//后台轮播图管理 hzh
Route::resource('admin/changepic','Admin\ChangepicController');

//后台广告管理 hzh
Route::resource('admin/advertisement','Admin\AdvertisementController');



//后台管理员人员管理 --lq
Route::resource('admin/users','Admin\AdminController');


