@extends('layouts.header')

@section('content')
    <div id="dcMain">
        <!-- 当前位置 -->
        <div id="urHere">Manage<b>></b><strong>Add Product Coupon</strong></div>
        <div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
            <h3><a href="{{url('/products')}}" class="actionBtn">Product List</a>Add Product Coupon</h3>
            <form action="{{url('/product/saveProductCoupon/'.$product->id)}}" method="post"
                  enctype="multipart/form-data">
                @csrf
                <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
                    <tr>
                        <td width="90" align="right">Product Name</td>
                        <td>
                            <input type="text" name="name" value="{{$product->name}}" class="inpMain" readonly/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">Coupons</td>
                        <td>
                            @foreach ($coupons as $coupon)
                                <input type="checkbox" name="coupons[]" value="{{$coupon->id}}"
                                       @if(in_array($coupon->id,$productCouponIds)) checked @endif
                                >{{$coupon->name}}
                            @endforeach
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
