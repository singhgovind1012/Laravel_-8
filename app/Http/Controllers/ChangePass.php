<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use Auth;
use Illuminate\Support\Facades\Hash;

class ChangePass extends Controller
{
    //
    public function CPassword(){
        return view('admin.body.change_password');
    }
    public function UpdatePassword(Request $request)
    {
        # code...
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed'
        ]);
        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword,$hashedPassword)){
            $user =User:: find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('success','Password Is Change Successfully');
        }else{
            return redirect()->route('login')->with('error','Current Password is invalid');

        }
    }
    public function ProfileUpdate(){
        if(Auth::user()){
            $user = User::find(Auth::user()->id);
            if($user){
                return view('admin.body.update_profile',compact('user'));
            }
        }
    }
    public function UserProfileUpdate(Request $request){
        $user = User::find(Auth::user()->id);
        if($user){
            $user->name =$request['name'];
            $user->email =$request['email'];
             
            $user->save();
            return Redirect()->back()->with('success','User profile is Update Successfully');
        }else{
            return Redirect()->back();
        }
    }
}
