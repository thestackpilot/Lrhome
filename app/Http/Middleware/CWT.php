<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\ConstantsController;

class CWT
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle( $request, Closure $next )
    {
        try {
            $accessToken = $request->bearerToken();

            if ( ! $accessToken )
            {
                return response()->json( ["message" => "Request not allowed."], 403 );
            }

            if ( ! $request->has( 'file_name' ) )
            {
                return response()->json( ["message" => "Required params missing."], 422 );
            }

            if ( strcmp( md5( ConstantsController::API_SECRET.trim( $request->file_name ) ), $accessToken ) !== 0 )
            {
                return response()->json( ["message" => "Unauthorized request"], 401 );
            }

        }
        catch ( \Exception$e )
        {
            return response()->json( ["message" => $e->getMessage()], 401 );
        }

        return $next( $request );
    }

}
