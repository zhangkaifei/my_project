<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use App\Http\Model\Users;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;
use Carbon\Carbon;
class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next , $name)
    {
        if($request->cookies->has('cu')){
            $cu = $request->cookie('cu');
            $user = new Users();
            $result = $user->searchUser($name);
            if($result['phone'] !== $cu)
            {
                echo  '身份不合法，禁止访问该内容';
                exit;
            }
        }else{
            echo  '身份未识别，禁止访问该内容';
            exit;
        }

        $response = $next($request);
        return $response;
    }

    public function terminate($request , $response)
    {
        //在响应发送到浏览器之后，所执行的一些操作
        //比如存储session会话数据
        //App()->singleton();
        $to = '175002316@qq.com';
        //邮件发送
        //Mail::to($to)->send();
        //邮件放入队列处理
        //Mail::to($to)->queue(new TestEmail());
        //延时队列中的邮件发送
        $when = Carbon::now()->addMinutes(1);
        Mail::to($to)->later($when , new TestEmail());
    }
}
