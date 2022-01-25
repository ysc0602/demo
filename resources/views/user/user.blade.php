@extends('layouts.header')

@section('content')
    <div id="dcMain">
        <!-- 当前位置 -->
        <div id="urHere">Manage<b>></b><strong>User List</strong></div>
        <div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
            <div id="list">
                <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
                    <tr>
                        <th width="40" align="center">NUMBER</th>
                        <th width="80" align="center">NAME</th>
                        <th width="80" align="center">EMAIL</th>
                        <th width="80" align="center">CREATED_TIME</th>
                        <th width="80" align="center">OPERATION</th>
                    </tr>
                    @foreach ($users as $key => $user)
                        <tr>
                            <td align="center">{{$key+1}}</td>
                            <td align="center">{{$user->name}}</td>
                            <td align="center">{{$user->email}}</td>
                            <td align="center">{{$user->created_at}}</td>
                            <td align="center">
                                <a href="{{url('/users/'.$user->id).'/edit'}}">edit</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="clear"></div>
        </div>
    </div>
@endsection
