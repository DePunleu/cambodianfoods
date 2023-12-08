<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthUserController extends Controller
{
    //===============Show Register Form===================//
    public function register()
    {
        return view('user.auth.register');
    }
    //=====================End Method======================//
    
    //===============Store Register========================//
    public function registerPost(Request $request)
    {
        $request -> validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            
        ]);
        $data['name'] = $request -> name;
        $data['email'] = $request -> email;
        $data['password'] = Hash::make($request -> password) ;
        $user = User::create($data);
        if(!$user){
            return redirect()->intended(route('register'))->with("error","Registration failed, please try again!");
        }
        return redirect()->intended(route('user_login'))->with("success","Registration success, Please Login to access the website!");
    }
    //=====================End Method==========================//

    //=====================Show Login Form=====================//
    public function user_login()
    {
        return view('user.auth.login');
    }
    //=====================End Method==========================//

    //=====================Login Post==========================//
    public function user_loginPost(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $arr = [
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'user', // add this line to ensure only users can login
        ];
        if (Auth::attempt($arr)) {
            return redirect('/');
        } else {
            return redirect('/login')->with('error', 'Wrong Email or Password !');
        }
    }
    //=====================End Method======================//

    //=====================Logout==========================//
    public function user_logout()
    {
        Auth::logout();
        return redirect('/');
    }
    //=====================End Method======================//

    // public function signup()
    // {
    //     return view('user.auth.signup');
    // }
}
