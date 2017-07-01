<?php

namespace App\Http\Controllers\Laravel\Route;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Model\Users;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;

class RouteController extends Controller
{
    private $course;

    public function __construct()
    {
        $this->course='这是章是关于laravel框架中路由的学习';
    }
    //
    public function r1($address)
    {


        echo '当前请求参数是:'.$address;
        return '<hr>'.$this->course;
    }

    public function bind($user)
    {
        echo $user['name'];
        return '取得用户信息';
    }

    public function spoof()
    {
        return view('Laravel.Route.form',['title'=>'这是一个关于表单中提交方法欺骗的用法']);
    }

    public function getMethod(Request $request)
    {
        $current = Route::current();

        return '<hr>当前请求类型：'.$request->getMethod();
    }

    public function loginIn( Request $request)
    {
        $user = new Users();
        $result = $user->searchUser('张三');
        $user_info = $result['phone'];
        $cookie = Cookie::make('cu',$user_info , 10);
        return redirect()->route('articles.show',['id'=>'5937c6e0c67983105e20f502'])->withCookie($cookie);
        //return '登陆';
    }

    public function logOut()
    {
        $cookie = Cookie::forget('cu');
        return redirect()->route('articles.show',['id'=>'5937c6e0c67983105e20f502'])->withCookie($cookie);
    }
}
