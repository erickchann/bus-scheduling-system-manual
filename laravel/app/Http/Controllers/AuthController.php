<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            "username" => "required",
            "password" => "required"
        ]);

        $credentials = $request->only(['username', 'password']);
        if ($validator->fails() || !Auth::attempt($credentials)) {
            return response()->json(['message' => 'invalid login'], 401);
        }

        $user = Auth::user();
        $token = md5($request->username);

        $user->update(['token' => $token]);

        return response()->json($token, 200);
    }

    public function logout(Request $request) {
        if (!$request->token) {
            return response()->json(['message' => 'invalid login'], 401);
        }

        User::where('token', $request->token)->first()->update(['token' => '']);

        return response()->json(['message' => 'logout success'], 200);
    }
}
