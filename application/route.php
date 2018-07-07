<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// return [
//     '__pattern__' => [
//         'name' => '\w+',
//     ],
//     '[hello]'     => [
//         ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//         ':name' => ['index/hello', ['method' => 'post']],
//     ],

// ];
//设置路由
use think\Route;
//首页
Route::controller('/index','index/Index');
//前台登录
Route::controller('/login','index/Login');
//前台注册
Route::controller('/register','index/Register');
//前台个人中心
Route::controller('/person','index/Person');
//前台友情链接
Route::controller('/homelink','index/Link');
//后台登录
Route::controller('/adminlogin','admin/Login');
//后台首页
Route::controller('/admin','admin/Index');
//前台用户模块
Route::controller('/users','admin/Users');
//后台用户模块
Route::controller('/adminusers','admin/Adminusers');
//后台权限管理模块
Route::controller('/roles','admin/Roles');
//节点管理
Route::controller('/nodes','admin/Nodes');
//分类模块
Route::controller('/cates','admin/Cates');
//商品管理
Route::controller('/goods','admin/Goods');

//商品详情管理
Route::controller('/goodsinfo','admin/GoodsInfo');

//后台订单
Route::controller('/orders','admin/Orders');
//后台订单详情
Route::controller('/ordersInfo','admin/OrdersInfo');

//前台购物车
Route::controller('/homecarts','index/Carts');
//前台订单
Route::controller('/homeorders','index/Orders');
//前台订单详情
Route::controller('/homeorderinfo','index/OrderInfo');
//支付
Route::controller('/homepay','index/Pay');


//前台商品列表
Route::controller('/homegoods','index/Goods');
//前台商品详情
Route::controller('/homegoodsinfo','index/GoodsInfo');

//公告管理
Route::controller('/notice','admin/Notice');
//公告详情
Route::controller('/notices','index/Notices');
//广告管理
Route::controller('/ads','admin/Ads');
// //广告详情
// Route::controller('/adss','index/Adss');
//轮播图管理
Route::controller('/pics','admin/Pics');
//友情链接管理
Route::controller('/link','admin/Link');
//后台站内信
Route::controller('/adminmail','admin/Adminmail');


//后台限时抢购
Route::controller('/shopping','admin/Shopping');
//后台用户评价管理
Route::controller('/assess','admin/Assess');


Route::controller('/shopping','admin/Shopping');
//后台客服
Route::controller('/customer','admin/Customer');
//前台客服
Route::controller('/homecustomer','index/Customer');
//天气模块
// Route::controller('/weather','index/Weather');
