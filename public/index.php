<?php
//logging function
function prr( $var )
{

    if ( is_array( $var ) || is_object( $var ) )
    {
        $var = print_r( $var, true );
    }

    $filename = "vcs.log";

    if ( file_exists( $filename ) && date( "Y-m-d", filemtime( $filename ) ) != date( 'Y-m-d' ) )
    {

        if ( ! is_dir( "logs" ) )
        {
            mkdir( "logs" );
        }

        rename( $filename, 'logs/'.date( "Y-m-d", filemtime( $filename ) ).'.log' );
    }

    $fp = fopen( $filename, 'a' );

    if ( $fp == false )
    {
        return;
    }

    $script_name = pathinfo( $_SERVER['PHP_SELF'], PATHINFO_FILENAME );
    $time        = @date( '[d/M/Y:H:i:s]' );
    fwrite( $fp, "$time ($script_name) $var".PHP_EOL );
    fclose( $fp );
}

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

define( 'LARAVEL_START', microtime( true ) );

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels great to relax.
|
 */

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
 */

$app = require_once __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
 */

$kernel = $app->make( Illuminate\Contracts\Http\Kernel::class );

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate( $request, $response );
