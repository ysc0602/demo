@extends('layouts.header')

@section('content')
    <div id="dcMain">
        <!-- 当前位置 -->
        <div id="urHere">Manage<b>></b><strong>Coupon List</strong></div>
        <div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
            <h3><a href="{{url('/coupons/create')}}" class="actionBtn add">Add Coupon</a>Coupon List</h3>
            <div id="list">
                <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
                    <tr>
                        <th width="40" align="center">NUMBER</th>
                        <th width="80" align="center">NAME</th>
                        <th width="80" align="center">AMOUNT</th>
                        <th width="150" align="center">START_TIME</th>
                        <th width="150" align="center">END_TIME</th>
                        <th width="80" align="center">CREATED_TIME</th>
                        <th width="80" align="center">OPERATION</th>
                    </tr>
                    @foreach ($coupons as $key => $coupon)
                        <tr>
                            <td align="center">{{$key+1}}</td>
                            <td align="center">{{$coupon->name}}</td>
                            <td align="center">{{$coupon->amount}}</td>
                            <td align="center">{{$coupon->start_time}}</td>
                            <td align="center">{{$coupon->end_time}}</td>
                            <td align="center">{{$coupon->created_at}}</td>
                            <td align="center">
                                <a href="{{url('/coupons/'.$coupon->id).'/edit'}}">edit</a> |
                                <a href="{{url('/coupon/destroy/'.$coupon->id)}}">delete</a> |
                                <a href="{{url('/couponProductList/'.$coupon->id)}}">product list</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="clear"></div>
        </div>
    </div>
@endsection
