<?php

use App\Http\Middleware\OnceBasicMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->append(OnceBasicMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {

        $exceptions->renderable(function (UnauthorizedHttpException $e) {
            return response()->json([
                "data" => "Unauthorized",
            ], 401);
        });
        $exceptions->renderable(function (MethodNotAllowedHttpException $e) {
            return response()->json([
                "data" => "error request",
            ], 405);
        });

        $exceptions->renderable(function (NotFoundHttpException  $e) {
            return response()->json([
                "data" => "not found",
            ], 404);
        });

        // $exceptions->renderable(function(Throwable $e) {
        //     return response()->json([
        //         "data" => "something went error",
        //     ],500);
        // });
    })->create();
