<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthAccountantController extends Controller
{
    //===============Show Login Form===================//
    public function accountant_login()
    {
        return view('accountant.auth.login');
    }
    //=============== End Method ====================//
    
    //=============== Accountant Login Post ===================//
    public function accountant_loginPost(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $arr = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($arr)) {
            return redirect('/accountant/dashboard');
        } else {
            return redirect('/accountant')
                ->with('alert', 'Wrong Email or Password !');
        }
    }
    //================End Method=====================//

    //================Logout=====================//
    public function logout()
    {
        Auth::logout();
        return redirect('/accountant');
    }
    //=============== End Method ====================//
}
