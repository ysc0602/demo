@extends('layouts.header')

@section('content')
    <div id="dcMain">
        <!-- 当前位置 -->
        <div id="urHere">Manage<b>></b><strong>Add Coupon</strong></div>
        <div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
            <h3><a href="{{url('/coupons')}}" class="actionBtn">Coupon List</a>Add Coupon</h3>
            <form action="{{url('/coupons')}}" method="post" enctype="multipart/form-data">
                @csrf
                <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
                    <tr>
                        <td width="90" align="right">Coupon Name</td>
                        <td>
                            <input type="text" name="name" value="" class="inpMain"/>
                        </td>
                    </tr>
                    <tr>
                        <td width="90" align="right">Coupon Amount</td>
                        <td>
                            <input type="text" name="amount" value="" class="inpMain"/>
                        </td>
                    </tr>
                    <tr>
                        <td width="90" align="right">Start Time</td>
                        <td>
                            <input type="text" name="start_time" value="" class="inpMain"/>
                            <b style="color: red">'For Example ：2022-01-01'</b>
                        </td>
                    </tr>
                    <tr>
                        <td width="90" align="right">End Time</td>
                        <td>
                            <input type="text" name="end_time" value="" class="inpMain"/>
                            <b style="color: red">'For Example ：2022-02-02'</b>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input name="submit" class="btn" type="submit" value="Submit"/>
                        </td>
                    </tr>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li style="color: red">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </table>
            </form>
        </div>
    </div>
@endsection
