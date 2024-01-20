<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthSellerController extends Controller
{
    //===============Show Login Form===================//
    public function seller_login()
    {
        return view('seller.auth.login');
    }
    //=============== End Method ====================//
    
    //=============== Seller Login Post ===================//
    public function seller_loginPost(Request $request)
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
            return redirect('/seller/item');
        } else {
            return redirect('/seller')
                ->with('alert', 'Wrong Email or Password !');
        }
    }
    //================End Method=====================//

    //================Logout=====================//
    public function logout()
    {
        Auth::logout();
        return redirect('/seller');
    }
    //=============== End Method ====================//
}
