<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function Register(Request $request){
       try{
         $validatedData= $request->validate([
            'name'=>'string|max:255|required',
            'email'=>'required|email|unique:users',
            'password'=>'required|string|min:8'
        ]);
    
         $validatedData['password']=Hash::make($validatedData['password']);
         $user=User::create($validatedData);
         $token= $user->createToken('auth_token')->plainTextToken;

         return response()->json([
            'success'=>true,
            'message'=>'User Registered Successfully!',
            'user'=>[
               'name'=>$user->name,
               'email'=>$user->email
                     ]
                 ]);
       }catch(ValidationException $e){
        return response()->json([
            'success'=>false,
            'message'=>'Validation Failed',
            'error'=>$e->errors()
        ]);
       }catch(Exception $e){
        return response()->json([
            'success'=>false,
            'message'=>'Regestration failed. Please try again.',
            'error'=>$e->errors()
        ]);
       }
    }
    public function Login(Request $request){
        try{
            $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if(Auth::attempt($request->only('email', 'password'))){
            $user=Auth::user();
        $token=$user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'succcess'=>true,
                'message'=>'user logged in successfully',
                'user'=>$user
            ]);
        }else{
            return response()->json([
                'success'=>false,
                'message'=>'Invalid credentials'
            ]);
        }
        }catch(Exception $e){
           return response()->json([
             'success'=>false,
            'message'=>'Logged in failed'
           ],500);
        }
    }
    public function logout(Request $request){
        try{
            $request->user()->currentAccessToken()->delete();
            return response()->json([
                'success'=>true,
                'message'=>'User Logged out Successfully'
            ]);

        }catch(Exception $e){
            return response()->json([
                'success'=>false,
                'message'=>'Logout failed'
            ]);
        }
    }
}
