<?php

namespace App\Exceptions;

use App\Http\Helpers\DefaultResponsePayload;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{

    const VALIDATION_EXCEPTION_MESSAGE = 'Invalid request body';

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {

        if ($exception instanceof ValidationException) {
            return $this->validationExceptionResponse($exception);
        }

        //return parent::render($request, $exception);
        //return response()->json(['error' => $exception->getMessage()], 500);
    }

    private function validationExceptionResponse(ValidationException $exception)
    {
        $errors = [];
        foreach ($exception->errors() as $key => $value) {
            $errors[$key] = $value[0];
        }
        $responsePayload = new DefaultResponsePayload([], self::VALIDATION_EXCEPTION_MESSAGE, $errors);
        return response()->json( $responsePayload->toArray() , 400);
    }
}
