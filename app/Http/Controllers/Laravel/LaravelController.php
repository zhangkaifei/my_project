<?php

namespace App\Http\Controllers\Laravel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Traint\CommonTraint;
use App\Http\Model\Mongodb;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Crypt;
class LaravelController extends Controller
{
    use CommonTraint;
    private $db;
    public function __construct()
    {
        $this->db = new Mongodb();
    }
    //
    public function index()
    {
        $id = '5937c70bc67983098b4807e1';
        $col = $this->db->table('articles');
        $art = $col->find($id);
        if(!empty($art))
        {
            //$where['_id'] = $col->convertKey($art['_id']);
            $up_id = '5937ad89c67983105e20f501';
            $data = ['_id'=>$col->convertKey($up_id) , 'post_id'=>$id];
            $result = $this->db->table('comments')->update($data);
            if($result > 0)
            {
                return '更新成功';
            }
        }

        return '更新失败';
    }

    public function chkEnv()
    {
        echo phpinfo();
        return '取得当前应用的配置信息';
    }

    //Laravel中cookie的使用方式
    public function addCookieForNext(Request $request)
    {

        if(Cookie::has('web_title'))
        {
            Cookie::queue('web_title',null);

        }else{
            Cookie::queue('web_title' , 'Laravel中cookie的使用方式');
        }

        return redirect()->route('laravel_get_cookie');
    }

    public function getCookieFromFront()
    {
        return '网页的标题是：'.Cookie::get('web_title','cookie key未设置');
    }

    public function getAssignCookie(Request $request)
    {
        dd($request->cookies);
        return '网页的标题是：'.Cookie::get('web_title','cookie key未设置');
    }

    //session跨域共享测试

    public function testSession()
    {
        //echo ini_get('session.name')."\r\n";
        session(['name'=>'李芳珍']);
        //return route('find_user',['id'=>'5938b0e5c67983098f2ad012']);
        return redirect('http://user.app.com/user/5938b0e5c67983098f2ad012');
    }

    public function getSessionInfo(Request $request,$sessid)
    {
        //dd($request->cookies);
        //echo '当前session可用的domain设置:'.ini_get('session.cookie_domain');
        $key = 'laravel:'.$sessid;
        $session = Redis::get($key);
        $data = Crypt::decrypt($session);
        dd($data);
        Session::setId($sessid);
        Session::start();
        //echo Session('title');
        //return ;
        return '<hr>获取session存储数据:'.session('title');
    }

}
