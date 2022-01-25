@extends('layouts.header')

@section('content')
    <div id="dcMain"> <!-- 当前位置 -->
        <div id="urHere">Manage</div>
        <div id="index" class="mainBox" style="padding-top:18px;height:auto!important;height:550px;min-height:550px;font-size: 50px">
            Welcome , {{Session::get('username')}}
        </div>
    </div>
@endsection
