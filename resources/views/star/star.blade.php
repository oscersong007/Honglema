<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta name="format-detection" content="telephone=no" />
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/starStyle/Font-Awesome/css/font-awesome.css">
    <link rel="stylesheet" href="/css/starStyle/star.css">
    <script src="/js/jquery-1.9.1.min.js"></script>
{{--    <link rel="stylesheet" href="http://apps.bdimg.com/libs/jquerymobile/1.4.5/jquery.mobile-1.4.5.min.css">
    <script src="http://apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/jquerymobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>--}}
</head>
<body>

<div  id="" class="header">
    <ul><li> @yield('back')</li>
        <li> @yield('title')</li>
        <li> @yield('header_handle')</li></ul>
</div>
@section('square_header')
@show
@section('nav')
@show
<div id="">
    @section('context')
    @show
</div>

    @section('footer')
<div class="tail">
    <div >
        <a href="/star/square"><i class="icon-home"></i>网红广场</a></div>
    <div >
            <a href="/star/activity"><i class="icon-calendar"></i>活动广场</a></div>
    <div >
        <a href="/star/contention"><i class="icon-user"></i>活动订单</a></div>
    <div >
        <a href="/star/info?opendid=openid"><i class="icon-user"></i>我的</a></div>
</div>
        @show
</body>
</html>