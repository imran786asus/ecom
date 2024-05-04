<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function adminLogin(Request $request){
        if($request->isMethod('get')){
            return view('auth.login');
        }else{
            $validator = Validator::make($request->all(), [
                'email'=> 'required|email',
                'password'=> 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => 400, 'error' => 'Invalid parameters', 'message' => $validator->errors()->first()], 400);
            }
            $admin = User::where('email',$request->email)->where('role',1)->first();
            if(!$admin){
                return response()->json(['status' => 400,'message' => 'Account does not exist.']);
            }
            $credentials = $request->only('email', 'password');
            if(Auth::attempt($credentials)){
                return response()->json(['status' => 200 , 'url' => route('admin.dashboard')]);
            }else{
                return response()->json(['status' => 400,'message' => 'Invalid Credentials.']);
            }
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
