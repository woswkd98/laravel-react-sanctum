<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function Login(Request $request) {
        
        try{
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
                //'device_name' => 'required',
            ]);

            $credentials = $request->only('email', 'password');

            if(!Auth::attempt($credentials))
            {
                return response()->json([
                    'msg' => 'unauthorized'
                ], 200);
            }
            
            $user = User::where('email', $request->email)->first();
            
            if(!Hash::check($request->password, $user->password,  ['round' => env('PASSWORD_HASH_ROUND')]))
            {
                return response()->json([
                    'password not match'
                ], 200);
            }

            return response()->json([
                    'msg' => 'success'
            ],200);
      

        } catch (Exception $e) {
            return response()->json([
                    'msg' => 'Error in login',
                    'error' => $e
                ], 200);
            
        }
       
    }

    public function logout(Request $request) {
        
        // Auth::logout()이 안되므로 쿠키 자체를 날려버렸다
        //Auth::logout();
        $cookie = Cookie::forget('laravel_session');
        Cookie::queue($cookie);
        //$cookie = Cookie::forget('XSRF-TOKEN');
        //Cookie::queue($cookie);
        return response()
        ->json([
            'msg' => 'success'
        ], 200);


    }
}
