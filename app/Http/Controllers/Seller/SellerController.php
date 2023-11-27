<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Validated;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SellerController extends Controller
{
    //====================Update Seller Password========================//
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
        return view('seller.home.seller.update_password');
    }
    //======================== End Method =========================//
    //=============== Check current seller password ================//
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
    //=============== End Update Seller Password ================//

    //=============== Update Seller Details ====================//
    public function update_details(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            $rules = [
                'seller_name' => 'required|alpha|max:255',
                'seller_phone' => 'required|numeric',
            ];
            $this->validate($request,$rules);
            //upload seller Image
            if($request->hasFile('v_image')){
            $image_tmp = $request->file('seller_image');
            if($image_tmp->isValid()){
                //Get image extension
                $extension = $image_tmp->getClientOriginalExtension();
                //Generate new image name
                $imageName = rand(111,99999).'.'.$extension;
                //Save image to public folder
                $image_path = $request->file('seller_image')->storeAs('backend/images', $imageName);
                //$image_path = (public_path('backend/images/').$imageName);
                Image::make($image_tmp)->save($image_path);
                }
            }else if(!empty($data['current_image'])){
                $imageName = $data['current_image'];
            }else{
                $imageName = "";
            }
            
            //update seller details
            User::where('email',Auth::guard('web')->user()->email)->update(['name'=>$data['seller_name'],'phone'=>$data['seller_phone'],'image'=> $imageName]);
            return redirect()->back()->with('success_message', 'seller details has been updated successfully!');
        }
        return view('seller.home.seller.update_details');
    }
    //==================End Update Seller Details=======================//

    //==================Start Update user Details=======================//
    public function updateUserRole(Request $request, $userId) {
        // Fetch the user
        $user = User::find($userId);
    
        // Update the user role
        $user->role = $request->input('user_role');
        $user->save();
    
        // Redirect or show a success message
        return redirect()->back()->with('message', 'User role updated successfully!');
    }
    //==================End Update user Details=======================//
    
}
