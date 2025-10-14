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
         Auth::login($user);

         return response()->json([
            'success'=>true,
            'message'=>'User Registered Successfully!',
            'user'=>[
                'id'=>$user->id,
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
}
