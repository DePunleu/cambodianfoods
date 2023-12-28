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
            // If the provided infomation is not meet the requird then inform erorr
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
        // check the incoming request data if the data is a valid format or not
        $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        // store the user input (email and password) from the request
        $arr = [
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'user', // this line to ensure only users can login
        ];
        // Authentication Attempt by checking $arr
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

}
