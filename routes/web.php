<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Optional test route
Route::get('/test-web', function() {
    return response()->json(['message' => 'Web route works!']);
});
