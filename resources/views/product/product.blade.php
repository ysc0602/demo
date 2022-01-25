@extends('layouts.header')

@section('content')
    <div id="dcMain">
        <!-- 当前位置 -->
        <div id="urHere">Manage<b>></b><strong>Product List</strong></div>
        <div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
            <h3><a href="{{url('/products/create')}}" class="actionBtn add">Add Product</a>Product List</h3>
            <div id="list">
                <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
                    <tr>
                        <th width="40" align="center">NUMBER</th>
                        <th width="80" align="center">NAME</th>
                        <th width="150" align="center">IMAGE</th>
                        <th width="80" align="center">CREATED_TIME</th>
                        <th width="80" align="center">OPERATION</th>
                    </tr>
                    @foreach ($products as $key => $product)
                        <tr>
                            <td align="center">{{$key+1}}</td>
                            <td align="center">{{$product->name}}</td>
                            <td align="center"><img
                                        src="{{asset('storage/'.$product->image_path)}}"></td>
                            <td align="center">{{$product->created_at}}</td>
                            <td align="center">
                                <a href="{{url('/products/'.$product->id).'/edit'}}">edit</a> |
                                <a href="{{url('/product/destroy/'.$product->id)}}">delete</a> |
                                <a href="{{url('/product/addProduceCoupon/'.$product->id)}}">addCoupon</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="clear"></div>
        </div>
    </div>
@endsection
