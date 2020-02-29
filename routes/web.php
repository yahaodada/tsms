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

// Route::get('/show', function () {
// 	$name='1908 欢迎您';
//     return view('welcome',['name'=>$name]);
// });
// Route::get('/show', function () {
// 	echo '这是商品详情页';
// });
// //路由显示试图  
// Route::get('/shows','StudentController@index' );
// Route::get('/show/{id}',function($goods_id){
// 	echo "商品id是";
// 	return "$goods_id";
// })->where(['id'=>'[0-9]+']);
// Route::get('/show/{id}/{na}',function($goods_id,$name){
// 	echo "商品id是";
// 	echo "'$goods_id'";
// 	echo "关键字是：";
// 	return "$name";
// });
// Route::get('/brand/add',function(){
// 	return view('brand');
// });
// Route::get('/brand/adds','StudentController@brands');
// Route::view('category/add','brands',['fid'=>'服装'])->name('do');
// Route::get('/shows/{id}','StudentController@ass');
Route::get('/','Index\IndexController@index');
Route::view('/login','index.login');
Route::view('/rlbg','index.reg');
Route::get('/send','Index\IndexController@ajaxsend');
Route::get('/admins/weiyi','AdminsController@weiyi');
Route::post('/admins/store','AdminsController@store');
Route::get('/index/ajaxsend','Index\IndexController@ajaxsend');
Route::post('/index/login','AdminsController@index');
Route::get('/index/edit/{id}','Index\IndexController@edit');
Route::get('/index/cart','Index\IndexController@cart');

Route::prefix('people')->middleware('checklogin')->group(function(){
Route::get('create','PeopleController@create');
Route::post('store','PeopleController@store');
Route::get('index','PeopleController@index');
Route::get('edit/{id}','PeopleController@edit');
Route::post('update/{id}','PeopleController@update');
Route::get('destroy/{id}','PeopleController@destroy');
});
	//  Route::prefix('student')->group(function(){
	//  Route::get('create','AdminController@create');
	//  Route::post('store','AdminController@store');
	//  Route::get('index','AdminController@index');
	//  Route::get('destort/{id}','AdminController@destroy');
	//  Route::get('edit/{id}','AdminController@edit');
	//  Route::post('update/{id}','AdminController@update');
	// });
	 //品牌
			Route::get('/brand/insert','BrandController@create');
			Route::post('/brand/store','BrandController@store');
			Route::get('/brand/index','BrandController@index');
			Route::get('/brand/destroy/{id}','BrandController@destroy');
			Route::get('/brand/edit/{id}','BrandController@edit');
			Route::post('/brand/update/{id}','BrandController@update');
//登陆
// Route::get('/login','LoginController@create');
// Route::post('/login/logindo','LoginController@store');
//周考
//->middleware('checklogin')
Route::prefix('zhou')->group(function(){
	Route::get('insert','ZhouController@create');
	Route::post('store','ZhouController@store');
	Route::get('index','ZhouController@index');
	Route::get('edit/{id}','ZhouController@edit');
	Route::post('update/{id}','ZhouController@update');
	Route::get('destroy/{id}','ZhouController@destroy');
	Route::get('destroy/{id}','ZhouController@destroy');
	Route::get('shanchu','ZhouController@shanchu');
	Route::post('weiyi','ZhouController@weiyi');
	Route::post('xweiyi','ZhouController@xweiyi');
});
//分类
			Route::get('/caregory/insert','CaregoryController@create');
			Route::post('/caregory/store','CaregoryController@store');
			Route::get('/caregory/index','CaregoryController@index');
			Route::get('/caregory/destroy/{id}','CaregoryController@destroy');
			Route::get('/caregory/edit/{id}','CaregoryController@edit');
			Route::post('/caregory/update/{id}','CaregoryController@update');
//商品
Route::prefix('goods')->middleware('checklogin')->group(function(){
	Route::get('insert','GoodsController@create');
	Route::post('store','GoodsController@store');
	Route::get('index','GoodsController@index');
	Route::get('edit/{id}','GoodsController@edit');
	Route::post('update/{id}','GoodsController@update');
	Route::get('destroy/{id}','GoodsController@destroy');
	Route::get('destroy/{id}','GoodsController@destroy');
	Route::get('shanchu','GoodsController@shanchu');
	Route::post('weiyi','GoodsController@weiyi');
});
//管理员
Route::prefix('user')->middleware('checklogin')->group(function(){
	Route::get('insert','UserController@create');
	Route::post('store','UserController@store');
	Route::get('index','UserController@index');
	Route::get('edit/{id}','UserController@edit');
	Route::post('update/{id}','UserController@update');
	Route::get('destroy/{id}','UserController@destroy');
	Route::get('destroy/{id}','UserController@destroy');
	Route::get('shanchu','UserController@shanchu');
	Route::post('weiyi','UserController@weiyi');
	Route::post('xweiyi','UserController@xweiyi');
});
//周测管理员
Route::prefix('guanliyuan')->group(function(){
Route::get('create','GuanliyuanController@create');
Route::post('store','GuanliyuanController@store');
});
//周测仓库
Route::prefix('cangku')->middleware('adminlogin')->group(function(){
	Route::get('index','CangkuController@index');
	Route::get('yonghu','CangkuController@yonghu');
	Route::get('destroy/{id}','CangkuController@destroy');
});