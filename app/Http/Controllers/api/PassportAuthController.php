<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\balance;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class PassportAuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed',

        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        if($user->save()){
            //j
            balance::create([
                'user_id' => $user->id,
                'cash' => 0,
            ]);

            return response()->json([
                'massage' => 'User register',
                'status_code' => 201,
                'user' => $user
            ],201);
        }else{
            return response()->json([
                'massage' => 'User not register, please try again',
                'status_code' => 500,
            ],500);
        }
    }
    public function login(Request $request){
        $request->validate([
            'email' => 'email|required',
            'password' => 'required',
            'remember_me' => 'boolean'
        ]);
        if(!auth()->attempt(['email'=>$request->email,'password'=>$request->password])){
            return response()->json([
                'massage' => 'Unauthorized',
                'boolean' => $request->remember_me,
                'status_code' => 401,
            ],401);
        }
        $user = $request->user();
        $accessToken = $user->createToken('authUser',['make_user']);

        $token = $accessToken->token;
        if ($request->remember_me){
            $token->expires_at = Carbon::now()->addWeek(1);
        }
        if($token->save()){
            return response()->json([
                'user' => $user,
                'access_token'=> $accessToken->accessToken,
                'token_type' => 'Barer',
                'token_scope' => $accessToken->token->scopes[0],
                'expires_at' => Carbon::parse($accessToken->token->expires_at)->toDateTimeString(),
                'remember_me'=> $request->remember_me,
                'status_code' => 200,
            ],200);
        }else{
            return response()->json([
                'massage' => 'Error, please try again',
                'status_code' => 500,
            ],500);
        }
    }
    public function logout(Request $request){
        $request->user()->token()->revoke();
        return response()->json([
            'massage' => 'User logout',
            'status_code' => 200,
        ],200);
    }
}
