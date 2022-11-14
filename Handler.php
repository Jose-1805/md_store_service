<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponser;
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

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof HttpException) {
            $code = $exception->getStatusCode();
            $message = Response::$statusTexts[$code];
            return $this->generateResponse($message, $code);
        }
        if ($exception instanceof ModelNotFoundException) {
            $model = strtolower(class_basename($exception->getModel()));
            return $this->generateResponse("Does not exist any instance of {$model} with the given id", Response::HTTP_NOT_FOUND);
        }
        if ($exception instanceof AuthorizationException) {
            return $this->generateResponse($exception->getMessage(), Response::HTTP_FORBIDDEN);
        }
        if ($exception instanceof AuthenticationException) {
            return $this->generateResponse($exception->getMessage(), Response::HTTP_UNAUTHORIZED);
        }
        if ($exception instanceof ValidationException) {
            $errors = $exception->validator->errors()->getMessages();
            return $this->generateResponse($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        if ($exception instanceof ClientException) {
            $message = $exception->getResponse()->getBody();
            $code = $exception->getCode();

            return $this->generateResponse($message, $code);
        }
        if ($exception instanceof RouteNotFoundException) {
            return $this->generateResponse("Route not found (".$request->fullUrl().")", Response::HTTP_NOT_FOUND);
        }


        if (env('APP_DEBUG', false)) {
            return parent::render($request, $exception);
        }
        return $this->generateResponse('Unexpected error. Try later', Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
