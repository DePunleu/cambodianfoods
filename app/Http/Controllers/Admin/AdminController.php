<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Validated;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    //====================Update Admin Password========================//
    public function update_password(Request $request)
    {   
        // Check if the current request is a POST request
        if($request->isMethod('post')){
            // Retrieves all the input data from the POST request
            $data = $request->all();
            //Check if current password is correct
            if (Hash::check($data['current_password'], Auth::guard('web')->user()->password)) {
                //Check if new password and confirm password are matching
                if($data['new_password']==$data['confirm_password']){
                    User::where('id',Auth::guard('web')->user()->id)->update(['password'=>bcrypt($data['new_password'])]);
                    // Set success message to session
                return redirect()->back()->with('success_message', 'Password has been updated successfully!');
                }else{
                      // Set error message to session
                    return redirect()->back()->with('error_message','New password and Confirm password are not match!');
                }
            }else{
                return redirect()->back()->with('error_message','Your current password is Incorrect!');
            }
        }
        return view('admin.home.admin.update_password');
    }
    //======================== End Method =========================//

    //=============== Update Admin Details ====================//
    public function update_details(Request $request)
    {   // Check if the current request is a POST request
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'admin_name' => 'required|alpha|max:255',
                'admin_phone' => 'required|numeric',
            ];
            $this->validate($request,$rules);
            // Check if the request has a file named 'admin_image'
            if($request->hasFile('admin_image')){
            // Get the file from the request
            $image_tmp = $request->file('admin_image');

            if($image_tmp->isValid()){
                //Get image extension
                $extension = $image_tmp->getClientOriginalExtension();
                //Generate new image name
                $imageName = rand(111,99999).'.'.$extension;
                //Save image to public folder
                $image_path = $request->file('admin_image')->storeAs('backend/images', $imageName);
                //$image_path = (public_path('backend/images/').$imageName);
                Image::make($image_tmp)->save($image_path);
                }
            }else if(!empty($data['current_image'])){
                $imageName = $data['current_image'];
            }else{
                $imageName = "";
            }
            
            //update admin details and retrieves the user by email
            User::where('email',Auth::guard('web')->user()->email)
            ->update([
                'name'=>$data['admin_name'],
                'phone'=>$data['admin_phone'],
                'image'=> $imageName]);
            return redirect()->back()->with('success_message', 'Admin details has been updated successfully!');
        }
        return view('admin.home.admin.update_details');
    }
    //==================End Update Admin Details=======================//    
}


