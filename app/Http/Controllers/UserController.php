<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Users;
class UserController extends Controller
{
    //
    public function getUser(Request $request,$account,$id)
    {

        $user = new Users();
        $result = $user->findUser($id);
        //dd($request->cookies);
        echo '当前登陆用户:'.session('name');
        return '<hr>你所查找的用户的名字是：'.$result['name'];
    }
}
