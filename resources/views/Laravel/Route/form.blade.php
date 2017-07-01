<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title }}</title>

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }
        .layouts
        {
            margin:0 auto;
            width: 600px;
            padding-top: 100px;
        }
        .layouts form
        {
            width: 100%;
        }
    </style>
</head>
<body>
<div class="layouts">
    <form name="test_form" action="{{route('spoof_method')}}" method="post" enctype="application/x-www-form-urlencoded">
        用户名：<input name="username" type="text" maxlength="20"/>
        密码：<input name="password" type="password" maxlength="20"/>
        <input type="submit" name="subbtn" value="登陆">
        {{csrf_field()}}
        {{ method_field('put') }}
    </form>
</div>
</body>
</html>
