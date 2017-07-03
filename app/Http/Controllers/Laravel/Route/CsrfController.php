<?php

namespace App\Http\Controllers\Laravel\Route;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Controller;
class CsrfController extends Controller
{
    //
    public function index( Request $request)
    {
        //模板中使用csrf token的方法
        //使用Jq的ajaxSetUp方法来设置http header

        return view('Laravel.Route.csrf')->with('title','在ajax中使用csrf token 的方法');
    }
}
