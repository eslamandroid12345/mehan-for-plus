<?php

namespace App\Exceptions;

use App\Http\Traits\Responser;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenBlacklistedException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use Responser;
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Throwable $e
     * @return mixed
     * @throws Throwable
     */
    public function render($request, Throwable $exception)
    {

        if ($exception instanceof TokenExpiredException) {
            return $this->responseFail(status: 401, message: 'Token expired');
        }
        if ($exception instanceof TokenBlacklistedException) {
            return $this->responseFail(status: 401, message: 'Token blacklisted');
        }
        if ($exception instanceof TokenInvalidException) {
            return $this->responseFail(status: 401, message: 'Token invalid');
        }
        if ($exception instanceof JWTException) {
            return $this->responseFail(status: 401, message: 'JWT error');
        }
        if ($exception instanceof AuthenticationException) {
            if($request->expectsJson()) {
                return $this->responseFail(status: 401, message: 'Unauthenticated');
            } else {
                return redirect()->route('auth.login');
            }
        }

        return parent::render($request, $exception);
    }
}
