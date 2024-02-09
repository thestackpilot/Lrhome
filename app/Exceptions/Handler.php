<?php

namespace App\Exceptions;

use Throwable;
use ErrorException;
use App\Http\Controllers\Frontend\ErrorController;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation'
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render( $request, Throwable $exception )
    {

        if ( ! env( 'APP_DEBUG', true ) )
        {

            if ( $this->isHttpException( $exception ) )
            {
                return ( new ErrorController() )->index( $exception->getStatusCode() );
            }
            else

            if ( $exception instanceof \ErrorException )
            {
                return ( new ErrorController() )->index( 500 );
            }
        }

        return parent::render( $request, $exception );
    }

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report( Throwable $exception )
    {
        parent::report( $exception );
    }

}
