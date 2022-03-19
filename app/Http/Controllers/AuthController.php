<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{

    public function register(Request $request) {


        Log::info(print_r($request->all(),true));

        // validate the request
        $data  = $request->validate([
            'name' => 'string|required',
            'email' => 'required|string|email|unique:users,email',
            'username' => 'required|string|unique:users,username',
            'password' => ['required','confirmed', Password::min(8)->mixedCase()->numbers()->symbols()]
        ]);

        // Create a user model
        $user = User::create([
           'name' => $data['name'],
           'email' => $data['email'],
           'username' => $data['username'],
           'password' => bcrypt($data['password'])
        ]);

        // Generate token for user
        $token = $user->createToken('main')->plainTextToken;



        return response([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function login(Request $request) {

        $credentials = $request->validate([

            'email' => 'required|email|string|exists:users,email',
            'password' => [
                'required',
            ],
            'remember' => 'boolean'
        ]);

        $remember = $credentials['remember'] ?? false;
        unset($credentials['remember']);


        if (!Auth::attempt($credentials,$remember)) {
            return response([
                'error' => 'The Provided Credentials are incorrect'
            ], 422);
        }

        $user = Auth::user();

        $token = $user->createToken('main')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function logout(){
        $user = Auth::user();

        $user->currentAccessToken()->delete();

        return response([
            'success' => true
        ]);
    }
}
