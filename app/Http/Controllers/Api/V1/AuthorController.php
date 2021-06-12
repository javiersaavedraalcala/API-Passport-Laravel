<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
 
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:authors',
            'password' => 'required|confirmed',
            'phone_no' => 'required',
        ]);

        Author::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone_no' => $request->phone_no,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Author created successfully'
        ]);
    }

    public function login(Request $request)
    {
        // Validate
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(!auth()->attempt($request->all())) {

            return response()->json([
                'status' => false,
                'message' => 'Invalid credentials',
            ]);
        } 

        // Token
        $token = auth()->user()->createToken('auth_token');

        // Send response
        return response()->json([
            'status' => true,
            'message' => 'Author logged in successfully',
            'token' => $token->accessToken
        ]);

    }

    public function logout(Request $request)
    {
        // Get token
        $token = $request->user()->token();

        // Revoke this token
        $token->revoke();

        return response()->json([
            'status' => true,
            'message' => 'Author logged out successfully'
        ]);
    }

    public function profile()
    {
        $userData = auth()->user();

        return response()->json([
            'status' => true,
            'message' => 'User data',
            'data' => $userData
        ]);
    }
}
