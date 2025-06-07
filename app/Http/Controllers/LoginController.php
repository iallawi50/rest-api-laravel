<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        if(Auth::attempt(["email" => $request->email, "password" => $request->password])){
            $user = Auth::user();
           $accessToken = $user->createToken("Access Token")->plainTextToken;
            return response()->json([
                "data" => new UserResource($user),
                "token" => $accessToken
            ]);
        }

        return response()->json([
            "message" => "email or password error"
        ], 401);

    }
}
