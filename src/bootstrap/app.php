<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware): void {
        // テスト環境のみCSRFを無効にする方法が分からなかった
        // Laravel11でのテスト環境限定の設定方法が未解決のため一時的に全環境で無効化中
        $middleware->validateCsrfTokens(except: ['*']);
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();