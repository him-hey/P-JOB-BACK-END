<?php

namespace App\Http\Controllers\Api;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    //
    public function login(Request $request){
        try {
            $validateUser = Validator::make($request->all(),[
                'email' => 'required|email',
                'password' => 'required',
            ]);
            if($validateUser->fails())
            {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'error' => $validateUser->errors(),
                ], 401);
            }
            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'username or password does not match!',
                    'error' => $validateUser->errors(),
                ], 401);
            }
            $user = User::where('email', $request->email)->first();
            return response()->json([
                'status' => true,
                'message' => 'user login successful',
                'token' => $user->createToken("API TOKEN")->plainTextToken,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
    
    public function register(Request $request){
        try {
            $validateUser = Validator::make($request->all(),[
                'firstname' => 'required',
                'lastname' => 'required',
                'gender' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
            ]);
            if($validateUser->fails())
            {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'error' => $validateUser->errors(),
                ], 401);
            }
            $user = User::create(
                [
                    'firstname'=> $request->firstname,
                    'lastname'=> $request->lastname,
                    'gender'=> $request->gender,
                    'phone'=> $request->phone,
                    'status'=> $request->status,
                    'dateofbirth'=> $request->dateofbirth,
                    'email'=> $request->email,
                    'password'=> Hash::make($request->password),
                    'role_id'=> $request->role,
                ]
            );
            return response()->json([
                'status' => true,
                'message' => 'user create successful',
                'token' => $user->createToken("API TOKEN")->plainTextToken,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }

    }
}
