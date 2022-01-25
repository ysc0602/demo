<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link href="{{URL::asset('/css/public.css')}}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{URL::asset('/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/js/global.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('/js/jquery.autotextarea.js')}}"></script>
</head>
<body>
<div id="dcWrap">
    <div id="dcHead">
        <div id="head">
            <div class="nav">
                <ul class="navRight">
                    <li class="M noLeft"><a href="JavaScript:void(0);">Hello，{{Session::get('username')}}</a>
                    </li>
                    <li class="noRight"><a href="{{url('loginOut')}}">Sign Out</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- dcHead 结束 -->
    <div id="dcLeft">
        <div id="menu">
            <ul class="top">
                <li><a href="{{url('/')}}"><i class="home"></i><em>Home</em></a></li>
            </ul>
            <ul>
                <li><a href="{{url('/products')}}"><i class="product"></i><em>Product List</em></a></li>
            </ul>
            <ul>
                <li><a href="{{url('/coupons')}}"><i class="product"></i><em>Coupon List</em></a></li>
            </ul>
            <ul>
                <li><a href="{{url('/users')}}"><i class="product"></i><em>User List</em></a></li>
            </ul>
        </div>
    </div>

    <div class="container">
        @yield('content')
    </div>

    <div class="clear"></div>
</div>
</body>
</html>