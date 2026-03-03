<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AuthController extends Controller  // <-- Missing { here!
{
    /**
     * Register a new user
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Build abilities (scopes) and create token
        $abilities = $request->input('abilities', ['*']);
        if (is_string($abilities)) {
            $abilities = array_map('trim', explode(',', $abilities));
        }

        $tokenResult = $user->createToken('auth_token', $abilities ?: ['*']);
        $token = $tokenResult->plainTextToken;

        // Set custom expiration (30 days) if accessToken model is available
        if (isset($tokenResult->accessToken)) {
            $tokenResult->accessToken->expires_at = Carbon::now()->addDays(30);
            $tokenResult->accessToken->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'User registered successfully',
            'data' => [
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_at' => $tokenResult->accessToken->expires_at,
            ]
        ], 201);
    }

    /**
     * Login user and create token
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid login credentials'
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        
        // Build abilities and create token with 7 days expiration for logged in users
        $abilities = $request->input('abilities', ['*']);
        if (is_string($abilities)) {
            $abilities = array_map('trim', explode(',', $abilities));
        }

        $tokenResult = $user->createToken('auth_token', $abilities ?: ['*']);
        $token = $tokenResult->plainTextToken;

        if (isset($tokenResult->accessToken)) {
            $tokenResult->accessToken->expires_at = Carbon::now()->addDays(7);
            $tokenResult->accessToken->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'data' => [
                'user' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_at' => $tokenResult->accessToken->expires_at,
            ]
        ], 200);
    }

    /**
     * Get authenticated user data
     */
    public function user(Request $request)
    {
        try {
            $user = $request->user();
            
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found or not authenticated'
                ], 401);
            }
            
            $response = [
                'success' => true,
                'data' => [
                    'user' => $user,
                ]
            ];
            
            // Safely try to get token info
            try {
                $currentToken = $user->currentAccessToken();
                if ($currentToken) {
                    // Check if expires_at exists
                    $response['data']['token_id'] = $currentToken->id;
                    $response['data']['token_abilities'] = $currentToken->abilities;
                    
                    // Safely check expires_at
                    if (isset($currentToken->expires_at)) {
                        $response['data']['token_expires_at'] = $currentToken->expires_at;
                    } else {
                        $response['data']['token_expires_at'] = 'Column exists but is null';
                    }
                }
            } catch (\Exception $e) {
                $response['data']['token_error'] = $e->getMessage();
            }
            
            return response()->json($response, 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error',
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 500);
        }
    }

    /**
     * Refresh token (create new one with new expiration)
     */
    public function refreshToken(Request $request)
    {
        $user = $request->user();
        
        // Delete current token
        $current = $user->currentAccessToken();
        if ($current) {
            $current->delete();
        }

        // Create new token with fresh expiration (keep abilities from request if provided)
        $abilities = $request->input('abilities', ['*']);
        if (is_string($abilities)) {
            $abilities = array_map('trim', explode(',', $abilities));
        }

        $tokenResult = $user->createToken('auth_token', $abilities ?: ['*']);
        $token = $tokenResult->plainTextToken;

        if (isset($tokenResult->accessToken)) {
            $tokenResult->accessToken->expires_at = Carbon::now()->addDays(7);
            $tokenResult->accessToken->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Token refreshed successfully',
            'data' => [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'expires_at' => $tokenResult->accessToken->expires_at,
            ]
        ], 200);
    }

    /**
     * Logout user (revoke token)
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Successfully logged out'
        ], 200);
    }

    /**
     * Logout from all devices (revoke all tokens)
     */
    public function logoutAll(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Successfully logged out from all devices'
        ], 200);
    }
}