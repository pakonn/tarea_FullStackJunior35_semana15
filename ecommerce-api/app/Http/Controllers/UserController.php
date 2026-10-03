<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
     public function index()
    {
        $user= User::all();
        return response()->json(
            [
                'data'=>$user
            ]
        );
    }
    public function register(Request $request){
        try{        
            $user = $request->validate([
                'name' => 'required|string|max:100|min:5',
                'email' => 'required|string|email|max:200|unique:users',
                'password' => [
                    'required',
                    'string',
                    Password::min(8)
                    ->mixedCase() 
                    ->numbers() 
                    ->symbols() 
                ]
            ]);
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password'])
            ]);
            return response()->json([
                'message' => 'User registred successfully',
            ]);
        }catch(\Exception $error){
            return response()->json([
                'message'=>$error->getMessage()
            ]);
        }                        
    }
 
    public function login(Request $request){
        try{
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string|min:8'
            ]);
            $credentials = $request->only('email','password');
            if( Auth::attempt($credentials) ){
                $user = $request->user();
                $token = $user->createToken('auth_token')->plainTextToken;
            }
            return response()->json([
                'message' => 'User loged successfully',
                'user' => $user,
                'token' => $token,
                'type_token' => 'Bearer'  
            ]);
        }catch(\Exception $error){
            return response()->json([
                'message'=>$error->getMessage()
            ]);
        }
    }
}
