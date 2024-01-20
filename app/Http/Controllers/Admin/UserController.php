<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;


class UserController extends Controller
{
    //==================Show All Users=======================//
    public function users(Request $request){
        $users = User::orderByDesc('id')
        ->where(function ($query) {
            $query->where('role', 'user')
                  ->orWhere('role', 'seller')
                  ->orWhere('role', 'accountant');
        });
        $roleFilter = $request->input('role');
        $usersQuery = User::orderByDesc('id')
        ->whereNotIn('role', ['admin']); // Exclude 'admin' role from the query
        
        // Role Filtering
        if ($roleFilter) {
            $usersQuery->where('role', $roleFilter);
        }

        // Prepares data to be passed to the view.
        $users = $usersQuery->get();
        $count = 1;
        return view(
            'admin.home.users.list_users',
            compact(
                'count',
                'users'
            )
        );
    }
    //=====================End Method==========================//

    //==================Show Create Users Form=======================//
    public function create_user() {
        $users = User::all();
        return view('admin.home.users.create_users', compact('users'));
    }
    //=====================End Method==========================//

    //===============Store Create Users========================//
    public function create_userPost(Request $request){
        $data['name'] = $request -> user_name;
        $data['email'] = $request -> user_email;
        $data['password'] = Hash::make($request -> user_password) ;
        $data['phone'] = $request -> user_phone;
        $data['role'] = $request -> user_role;
        $data['address'] = $request -> user_address;             
            if($request->file('user_image')){
                $file = $request->file('user_image');
                $filename = date('YdmHi').$file->getClientOriginalName();
                $file -> move(public_path('frontend/user_images'),$filename);
                $data['image'] = $filename;
            }
            User::create($data);
            return redirect()->back()->with("success","User Created success!");
        
    }        
    //=====================End Method==========================//

    //==================Show Update Users Form=======================//
    public function update_user($id)
    {
        $user = User::where('id',$id)->first();
        return view('admin.home.users.update_users',['user'=>$user]);
    }
    //=====================End Method==========================//
    //==================Store Update Users =======================//
    public function update_userPost(Request $request, $id)
    {
        $user = User::find($id);
        $user->name=$request->user_name;
        $user->email=$request->user_email;
        $user->phone=$request->user_phone;
        $user->address=$request->user_address;
        if($request->file('user_image')){
            $file = $request->file('user_image');
            $filename = date('YdmHi').$file->getClientOriginalName();
            $file -> move(public_path('frontend/user_images'),$filename);
            $user['image'] = $filename;
        }
        $user->role=$request->user_role;
        $user->save();
        return redirect()->back()->with("success","Updated User successfully!");
    }
    //=====================End Method==========================//

    //==================Delete Users=======================//
    public function delete($id_user)
    {
        $delete = User::where('id', $id_user)->first();
        $delete->delete();
        return redirect('/admin/users')
        ->with("success","User deleted successfully!");
    }
    //=====================End Method==========================//
    

}
