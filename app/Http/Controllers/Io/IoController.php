<?php

namespace App\Http\Controllers\Io;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
class IoController extends Controller
{
    //
    public function request(Request $request,$sort=null,$price=null)
    {

        //检索当前路径
        echo $request->path();
        echo '<hr>';

        //检查当前请求路径是否为指定请求参数
        echo $request->is('io/*') ?  'access request' : 'deny request';
        echo '<hr>';

        //检索当前完整的请求路径
        //未包含query string
        echo $request->url();
        echo '<hr>';
        //包含query string eg follow ? partial
        echo $request->fullUrl();
        echo '<hr>';

        //检查请求方法 eg ['get','post']
        $method = $request->getMethod();
        echo $method;
        echo '<hr>';
        //验证请求方法
        if($request->isMethod('get'))
        {
            echo '当前请求的方法是：get';
            echo '<hr>';
        }

        //检索所有数据(表单输入)
        $all_data = $request->all();
        //dd($all_data);

        //检索某一个输入的值
        $name = $request->input('name');

        //可传入第二个参数，作为默认值
        $name = $request->input('name' , '张三');

        //当表单的中某项输入为一个数组是，用以下方式来访问数组中的值
        $first = $request->input('product.0.name'); //获取数组中第一个元素的值
        $all_names = $request->input('product.*.name');//获取数组中所有的内容

        //可以检索用户的输入，通过动态属性来访问(当使用动态属性访问用户输入时，laravel首先会查找form input 属性, 如果不存在，它会查找url parameters field)
        echo $price = $request->price;
        echo '<hr>';

        //检索json 请求数据，可以使用 “.” 访问形式，深入访问到json数组中
        $json_field = $request->input('user.name');

        //检索用户输入数据的一部分字段内容，可以使用only 或者 except 方法 ,当请求的key不存在时，value 为 null
        $input =  $request->only(['username','password']);
        $input =  $request->except(['credit_card']);
        // or
        $input =  $request->except('credit_card');

        //当访问的key实际存在于请求时，也可以使用intersect方法
        $input = $request->intersect(['username','password']);

        //确认一个用户的输入的值是否存在，可以用has 方法
        $is_exists = $request->has('name') ? true : false;

        //存储用户输入数据到session ，在下个请求中可以使用
        $flash_data = $request->flash();
        $only_data = $request->flashOnly(['username', 'email']);
        $except_data = $request->flashExcept('password');

        //flash 用户输入，然后跳转页面
        //return redirect()->withInput();
        //return redirect()->withInput($request->except('password'));

        //检索old input data
        $request->old('username');

        //模板中可以使用old方法
        $template = '<input type="text" name="username" value="{{ old(\'username\') }}">';

        //从请求中检索cookie
        $request->cookie('name');

        //附加一个cookie到响应中 , 连式的cookie方法可以传入更多的参数，可参照setCookie方法
        $minutes = 10;
        //return response('hello world')->cookie('name','value',$minutes);

        //创建cookie实例 ，并附加到响应

        $cookie = cookie('name','value',$minutes);
        //return response('today is fine')->cookie($cookie);

        //检索上传文件
        $request->file('photo'); //返回Illuminate\Http\UploadedFile 的实例
        //或者可以以访问动态属性的方式，获取上传文件信息
        $request->photo;

        //检查上传的文件是否存在

        $check = $request->hasFile('photo') ? 'the photo is exists' : 'none photo';

        //检查验证上传文件是否存在问题

        $valid = $request->file('photo')->isValid() ? 'file is ok' : 'file has a error';

        //获取文件路径，及文件的扩展。查看其它的文件上传类UploadedFile api访问http://api.symfony.com/3.0/Symfony/Component/HttpFoundation/File/UploadedFile.html

        $path = $request->file('photo')->path();
        $ext  = $request->file('photo')->extension();

        //存储文件使用store方法，参数为文件名，返回文件存储后的路径，该路径相对于filesystems中相关参数的配置
        $image_path = $request->file('photo')->store('images');

        //store方法可传入第二个参数，为filesystem文件配置的云存储的名称
        $image_path = $request->file('photo')->store('images' , 's3');

        //如果想使用指定的文件名称可以使用 storeAs方法
        $img_path = $request->file('photo')->storeAs('images', 'filename.jpg');
        $cloud_img_path = $request->file('photo')->storeAs('images', 'filename.jpg' ,'s3');

        return 'laravel 中 request 的各种使用方式';
    }

    public function response()
    {

        $storage = app('path.storage');
        dd($storage);
        return '<hr>laravel 中 response 的各种使用方式';
    }

    public function wxAuth()
    {

        return Socialite::with('weixin')->redirect();
    }

}
