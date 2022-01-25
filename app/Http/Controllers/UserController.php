<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\User;
use App\Services\ConvertService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $converObj;

    public function __construct(ConvertService $converObj)
    {
        // ID Encryption Object
        $this->converObj = $converObj;
    }

    /**
     * User Page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = User::get();

        return view('user/user', ['users' => $users]);
    }

    /**
     * Edit User Page
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $id = $this->converObj->stringToId($id);

        $user = User::where('id', $id)->first();

        return view('user/editUser', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',

        ], [
            'name.required' => 'Coupon Name Is Required',
            'email.required' => 'Email Is Required',
            'email.email' => 'Email Must Be Email',
        ]);

        $id = $this->converObj->stringToId($id);
        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return redirect('/users');
    }
}
