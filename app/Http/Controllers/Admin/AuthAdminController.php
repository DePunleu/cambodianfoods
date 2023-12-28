<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthAdminController extends Controller
{
    //===============Show Login Form===================//
    public function admin_login()
    {
        return view('admin.auth.login');
    }
    //=============== End Method ====================//
    
    //=============== Admin Login Post ===================//
    public function admin_loginPost(Request $request)
    {
        // check the incoming request data if the data is a valid format or not
        $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        // store the user input (email and password) from the request
        $arr = [
            'email' => $request->email,
            'password' => $request->password
        ];
        // Authentication Attempt by checking $arr
        if (Auth::attempt($arr)) {
            return redirect('/admin/dashboard');
        } else {
            return redirect('/admin')
                ->with('alert', 'Wrong Email or Password !');
        }
    }
    //================End Method=====================//

    //================Logout=====================//
    public function logout()
    {
        Auth::logout();
        return redirect('/admin');
    }
    //=============== End Method ====================//
}
