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

Route::get('/', function () {
    return view('welcome');
});

Route::domain('{account}.app.com')->group(function () {
    Route::get('user/{id}','UserController@getUser')->name('find_user');
});

/**
 * use crontab execute php script
 */

Route::get('/time' ,function()
{
    return '当前时间:'.date('Y-m-d H:i:s' , '1498614969');
}
);
/**
 * mongodb 数据库的使用
 * */
Route::Group(['prefix'=>'mongo'],function(){
    Route::get('article' , 'MongodbController@index');
    Route::get('post', 'MongodbController@insertPosts');
    Route::get('insert', 'MongodbController@insertArticle');
    Route::get('user', 'MongodbController@insertUser');
});

/**
 * Xdebug 调试
 */
Route::Group(['prefix'=>'debug'] , function(){
    Route::get("/env" , "XdebugController@env");
    Route::get("/sort" , "XdebugController@sort");
    Route::get("/dir" , "XdebugController@dir");
    Route::get("/debug" , "XdebugController@index");
    Route::get("/monkey/{n}/{m}","XdebugController@getLastMonkey");
    Route::get("/arr2sort","XdebugController@sortMutiArray");
    Route::get("/ordArr","XdebugController@getOrderdArray");
});

Route::Group(['namespace'=>'Laravel','prefix'=>'laravel'],function(){
    Route::get('/blog','LaravelController@index');
    Route::get('/chkEnv' , 'LaravelController@chkEnv');
    //laravel中cookie的使用
    Route::get('cookie/set','LaravelController@addCookieForNext')->name('laravel_set_cookie');
    Route::get('cookie/get','LaravelController@getCookieFromFront')->name('laravel_get_cookie');
    Route::get('cookie/old','LaravelController@getAssignCookie')->name('laravel_old_cookie');
    //session跨域共享测试
    Route::get('session/test','LaravelController@testSession')->name('laravel_session_test');
    Route::get('session/get/{sessid}','LaravelController@getSessionInfo')->name('laravel_session_get');


});

/**
 * Laravel 路由
 */
Route::Group(['prefix'=>'route','namespace'=>'Laravel\\Route'],function(){
    //设置参数匹配规则where方法
    Route::any('/r1/{args}','RouteController@r1')->where(['args'=>'[0-9a-z]+']);
    //设置可选参数args后跟“?”
    Route::any('/r1/{args?}','RouteController@r1');
    //为当前路由命名name方法,调用方法 route('route_name',['name'=>'laravel'])
    Route::any('/r1/{name}','RouteController@r1')->name('route_name');
    //路由模型绑定到url参数
    Route::get('bind/{user}','RouteController@bind');
    //方法欺骗
    Route::get('spoof' , 'RouteController@spoof');
    Route::any('getMethod' , 'RouteController@getMethod')->name('spoof_method');
    //模拟用户登陆
    Route::get('login','RouteController@loginIn');
    Route::get('loginOut','RouteController@logOut');
    //资源路由的使用方式
    //Route::resource('articles' , 'ArticleController' , ['only'=>['index','show'],'except'=>['create','store'],'names'=>['create'=>'art.build','destroy'=>'art.delete'],'parameters'=>['articles'=>'id']]);
    Route::resource('articles','ArticleController',['parameters'=>['articles'=>'id']]);

    //向middleware中附加参数 , param为所要传递的参数，多个参数之间用 : 分隔
    //Route::get('midware',function(){})->middleware('checkUser:param')
    //关于csrf protection 的使用

    Route::get('csrf' , 'CsrfController@index');

    //淘宝api调用测试
    Route::get('goods/show','RouteController@getProducts');
    Route::get('goods/detail','RouteController@getProDetail');

    //对方法中可变参数的使用与测试
    Route::get('testParam','RouteController@testParam');



});
/**
 * laravel5.4 最新路由定义方式
 */

Route::middleware(['mw1','mw2'])->group(function(){
    //Route::get('/', function(){});
});
/*Route::namespace('example')->group(function(){
    //Route::get('/', function(){});
});*/
Route::prefix('home')->group(function(){
    //Route::get('/', function(){});
});
//子域名路由
Route::domain('{subdomain}.example.com')->group(function(){
    //Route::get('user/{id}', function ($subdomain, $id) {});
});

/**
 * Laravel request 与 response 的使用
 *
 */
Route::Group(['prefix'=>'io','namespace'=>'io'],function(){
    Route::get('request/{sort?}/{price?}','IoController@request');
    Route::get('response','IoController@response');
});