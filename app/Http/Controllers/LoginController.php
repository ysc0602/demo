<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Login Page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        return view('login');
    }

    /**
     * Login In
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function loginIn(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'User name is required',
            'password.required' => 'Password is required'
        ]);

        // Get User
        $user = User::where('name', $request->username)->first();
        if (!$user) {
            return redirect(url('login'))->withErrors(['error' => 'Account does not exist']);
        }

        // Check User Password
        if (!Hash::check($request->password, $user['password'])) {
            return redirect(url('login'))->withErrors(['error' => 'Password error']);
        }

        // Save Login User Info To Session
        Session::put('username', $user->name);
        Session::put('userId', $user->id);
        Session::put('loginStatus', User::LOGIN_STATUS_UP);

        return redirect('/');
    }

    /**
     * Sign Out
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function loginOut()
    {
        Session::forget('username');
        Session::forget('loginStatus');

        return redirect('login');
    }

}
