@extends('layouts.header')

@section('content')
    <div id="dcMain">
        <!-- 当前位置 -->
        <div id="urHere">Manage<b>></b><strong>Coupon Product List</strong></div>
        <div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
            <h3><a href="{{url('/coupons')}}" class="actionBtn">Coupon List</a>Coupon Product List</h3>
            <div id="list">
                <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
                    <tr>
                        <th width="40" align="center">NUMBER</th>
                        <th width="80" align="center">NAME</th>
                        <th width="80" align="center">CREATED_TIME</th>
                    </tr>
                    @foreach ($products as $key => $product)
                        <tr>
                            <td align="center">{{$key+1}}</td>
                            <td align="center">{{$product['name']}}</td>
                            <td align="center">{{$product['created_at']}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="clear"></div>
        </div>
    </div>
@endsection
