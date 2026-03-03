<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    public function register()
    {
        // no-op
    }

    protected function shouldReturnJson($request, Throwable $e)
    {
        if ($request->expectsJson() || $request->is('api/*') || str_contains($request->getPathInfo(), '/api/')) {
            return true;
        }

        return parent::shouldReturnJson($request, $e);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        \Log::info('Handler::unauthenticated called', [
            'path' => $request->path(),
            'expectsJson' => $request->expectsJson(),
            'guards' => $exception->guards(),
        ]);

        if ($request->expectsJson() || $request->is('api/*') || str_contains($request->getPathInfo(), '/api/')) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
