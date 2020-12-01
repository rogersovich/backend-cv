<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Login;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
  public function login(Login $request)
  {
    $credentials = ['email' => $request->email, 'password' => $request->password];

    if (!$token = auth()->attempt($credentials)) {
      return response()->json(['error' => 'Unauthorized'], 401);
    }

    return $this->respondWithToken($token);
  }
  
  public function user(Request $request)
  {
    return response()->json(auth()->user());
  }
  
  public function logout()
  {
    auth()->logout();

    return response()->json(['message' => 'Successfully logged out']);
  }

  protected function respondWithToken($token)
  {
    return response()->json([
      'access_token' => $token,
      'token_type' => 'bearer',
    ]);
  }
  
}
