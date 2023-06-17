<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\StoreUserRequest;

class AuthController extends Controller
{
    public function logIn(Request $request)
    {
        $fields = $request->validate([
            'email'=> 'required|email:rfc,dns',
            'password' => 'required|string|max:255',
        ]);
        $user = User::where('email',$fields['email'])->first();
        if( !$user || !Hash::check($fields['password'], $user->password))
            return response('wrong credentials',400);
        
        $token = $user->createToken('appToken')->plainTextToken;
        return $token;
    }
    public function logOut(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response('logged out',200);
    }
}
