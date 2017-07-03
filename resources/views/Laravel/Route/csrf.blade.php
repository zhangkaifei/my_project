<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript" src="{{ asset('/js/jquery-1.7.2.min.js') }}"></script>
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
    <h1>在ajax中使用csrf token 的方法</h1>
</div>
<script>
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
</body>
</html>
