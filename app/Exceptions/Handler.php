<?php

namespace App\Exceptions;

use App\Http\Resources\BadInputExceptionResource;
use App\Http\Resources\ForbiddenResource;
use App\Http\Resources\InvalidMethodExceptionResource;
use App\Http\Resources\NotFoundResource;
use App\Http\Resources\ServerErrorExceptionResource;
use App\Http\Resources\UnauthenticatedResource;
use App\Http\Resources\UnauthorizedResource;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
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

        $this->renderable(function (\ErrorException $e, Request $request) {
            return (new ServerErrorExceptionResource($request))
                ->response()
                ->setStatusCode(500);
        });
        $this->renderable(function (UnauthorizedException $e, Request $request) {
            return (new UnauthorizedResource($request))
                ->response()
                ->setStatusCode(401);
        });
        $this->renderable(function (AuthenticationException $e, Request $request) {
            return (new UnauthenticatedResource($request))
                ->response()
                ->setStatusCode(401);
        });
        $this->renderable(function (MethodNotAllowedHttpException $e, Request $request) {
            return (new InvalidMethodExceptionResource($request))
                ->response()
                ->setStatusCode(405);
        });
        $this->renderable(function (HttpException $e, Request $request) {
            if ($e->getStatusCode() === 403) {
                return (new ForbiddenResource($request))
                    ->response()
                    ->setStatusCode(403);
            }
            if ($e->getStatusCode() === 401) {
                return (new UnauthorizedResource($request))
                    ->response()
                    ->setStatusCode(401);
            }
            if ($e->getStatusCode() === 404) {
                return (new NotFoundResource($request))
                    ->response()
                    ->setStatusCode(404);
            }
            if ($e->getStatusCode() === 422) {
                return (new BadInputExceptionResource($request))
                    ->response()
                    ->setStatusCode(422);
            }
            throw $e;
        });

        $this->renderable(function (NotFoundHttpException $e, Request $request) {
            return (new NotFoundResource($request))
                ->response()
                ->setStatusCode(404);

        });
    }
}
