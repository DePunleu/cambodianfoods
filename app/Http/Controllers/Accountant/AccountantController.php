<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Validated;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AccountantController extends Controller
{
    //====================Update accountant Password========================//
    public function update_password(Request $request)
    {
        if($request->isMethod('post')){
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
        return view('accountant.home.accountant.update_password');
    }
    //======================== End Method =========================//
    //=============== Check current Accountant password ================//
    public function check_current_password(Request $request)
    {
        $data = $request->all();
        dd($data);
        if (Hash::check($data['current_password'], Auth::guard('web')->user()->password)) {
        return "true";
        } else {
        return "false";
        }
    }
    //======================== End Method ======================//
    //=============== End Update Accountant Password ================//

    //=============== Update Accountant Details ====================//
    public function update_details(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'accountant_name' => 'required|alpha|max:255',
                'accountant_phone' => 'required|numeric',
            ];
            $this->validate($request,$rules);
            //upload accountant Image
            if($request->hasFile('accountant_image')){
            $image_tmp = $request->file('accountant_image');
            if($image_tmp->isValid()){
                //Get image extension
                $extension = $image_tmp->getClientOriginalExtension();
                //Generate new image name
                $imageName = rand(111,99999).'.'.$extension;
                //Save image to public folder
                $image_path = $request->file('accountant_image')->storeAs('backend/images', $imageName);
                //$image_path = (public_path('backend/images/').$imageName);
                Image::make($image_tmp)->save($image_path);
                }
            }else if(!empty($data['current_image'])){
                $imageName = $data['current_image'];
            }else{
                $imageName = "";
            }
            
            //update accountant details
            User::where('email',Auth::guard('web')->user()->email)->update(['name'=>$data['accountant_name'],'phone'=>$data['accountant_phone'],'image'=> $imageName]);
            return redirect()->back()->with('success_message', 'accountant details has been updated successfully!');
        }
        return view('accountant.home.accountant.update_details');
    }
    //==================End Update Accountant Details=======================//
    
}
