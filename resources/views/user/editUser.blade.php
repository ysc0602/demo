@extends('layouts.header')

@section('content')
    <div id="dcMain">
        <!-- 当前位置 -->
        <div id="urHere">Manage<b>></b><strong>Edit User</strong></div>
        <div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
            <h3><a href="{{url('/users')}}" class="actionBtn">User List</a>Edit User</h3>
            <form action="{{url('/user/'.$user->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
                    <tr>
                        <td width="90" align="right">User Name</td>
                        <td>
                            <input type="text" name="name" value="{{$user->name}}" class="inpMain"/>
                        </td>
                    </tr>
                    <tr>
                        <td width="90" align="right">Email</td>
                        <td>
                            <input type="text" name="email" value="{{$user->email}}" class="inpMain"/>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="hidden" name="id" value="{{$user->id}}">
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
