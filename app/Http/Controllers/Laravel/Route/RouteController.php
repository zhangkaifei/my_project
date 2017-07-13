<?php

namespace App\Http\Controllers\Laravel\Route;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use App\Http\Model\Users;
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
    /**
     * 配置TopClient参数，并返回其实例
     * params $format 返回信息所用的格式 json | xml
     */
    
    protected function getTopClientInstance($format = 'json')
    {
        $c = new \TopClient();
        $c->appkey = config('taobao.appkey');
        $c->secretKey = config('taobao.secretKey');
        $c->format = $format;
        return $c;
    }

    /**
     * 淘宝api测试
     */
    public function getProducts()
    {
        $c = $this->getTopClientInstance();
        $req = new \TbkItemGetRequest;
        $req->setFields("num_iid,title,pict_url,small_images,reserve_price,zk_final_price,user_type,provcity,item_url,seller_id,volume,nick");
        $req->setQ("女装");
        $req->setCat("16,18");
        /*$req->setItemloc("杭州");
        $req->setSort("tk_rate_des");
        $req->setIsTmall("false");
        $req->setIsOverseas("false");
        $req->setStartPrice("10");
        $req->setEndPrice("1000");
        $req->setStartTkRate("123");
        $req->setEndTkRate("123");
        $req->setPlatform("1");
        $req->setPageNo("123");
        $req->setPageSize("20");*/
        $resp = $c->execute($req);
        dd($resp);
        return $resp;
    }

    //
    protected function getSomeGoods($pageno = 500 , $pagesize = 10)
    {

        $c = $this->getTopClientInstance();
        $req = new \TbkItemGetRequest;
        $req->setPageNo($pageno);
        $req->setPageSize($pagesize);
        $req->setFields("num_iid");
        $req->setQ("男装");
        $req->setCat("16,18");
        return $c->execute($req);
    }
    public function getProDetail()
    {
        $goods = $this->getSomeGoods();
        $num_iids_arr = $goods->results->n_tbk_item;
        $num_iids = '';
        foreach($num_iids_arr as $val)
        {
            $num_iids .= $val->num_iid . ',';
        }

        $params = trim($num_iids , ',');

        $c = $this->getTopClientInstance();
        $req = new \TbkItemInfoGetRequest;
        $req->setFields("num_iid,title,pict_url,small_images,reserve_price,zk_final_price,user_type,provcity,item_url");
        $req->setPlatform("1");
        $req->setNumIids($params);
        $response = $c->execute($req);
        dd($response);

        return ;
    }

    protected function myFunc($params)
    {
        $ret = '';
        foreach(func_get_args() as $k=>$v)
        {
            $ret .= '参数'.($k+1).'-->'.$v.'  ';
        }
        return $ret;
    }

    public function testParam()
    {
        $array = ['name','age','country','sex'];
        echo $this->myFunc(...$array);
        return '<hr>如何使用可变参数';
    }

}
