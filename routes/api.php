<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;

// Test route (public) - PUT THIS FIRST
Route::get('/test', function() {
    return response()->json([
        'success' => true,
        'message' => 'API is working!',
        'timestamp' => now()->toDateTimeString()
    ]);
});

// debug: show the implementation of the exception handler currently bound
Route::get('/debug-handler', function () {
    return response()->json([
        'handler' => get_class(app(Illuminate\Contracts\Debug\ExceptionHandler::class)),
    ]);
});


// Public API routes (no authentication required)
Route::post('/register', [AuthController::class, 'register']);
// name the login route so the default Authenticate middleware can resolve it if
// it ever attempts to redirect (e.g. during unauthenticated requests).
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Protected API routes (require token)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/logout-all', [AuthController::class, 'logoutAll']);
    // Example route demonstrating abilities check
    Route::get('/admin-only', function (Request $request) {
        $token = $request->user()?->currentAccessToken();
        if (! $token || ! $token->can('admin')) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return response()->json(['success' => true, 'message' => 'Admin access granted']);
    });
});
