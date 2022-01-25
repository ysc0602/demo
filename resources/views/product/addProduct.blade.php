@extends('layouts.header')

@section('content')
    <div id="dcMain">
        <!-- 当前位置 -->
        <div id="urHere">Manage<b>></b><strong>Add Product</strong></div>
        <div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
            <h3><a href="{{url('/products')}}" class="actionBtn">Product List</a>Add Product</h3>
            <form action="{{url('/products')}}" method="post" enctype="multipart/form-data">
                @csrf
                <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
                    <tr>
                        <td width="90" align="right">Product Name</td>
                        <td>
                            <input type="text" name="name" value="" class="inpMain"/>
                        </td>
                    </tr>
                    <tr>
                        <td align="right">Image</td>
                        <td>
                            <input type="file" name="image" size="38" class="inpFlie"/>
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
