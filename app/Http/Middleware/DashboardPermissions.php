<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConstantsController;
use Session;

class DashboardPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle( $request, Closure $next, $sidebar )
    {

        if ( strcmp( ConstantsController::USER_ROLES['admin'], Auth::user()->role ) === 0 )
        {
            return redirect()->route( 'admin.basic_settings' );
        }

        $sidebar = unserialize( $sidebar );

        foreach ( $sidebar as $item )
        {

            if (
                $item['permission'] &&
                strcmp( $item['slug'], Route::currentRouteName() ) === 0 &&
                strcmp( ConstantsController::USER_ROLES['staff'], Auth::user()->role ) === 0 &&
                ! in_array( $item['permission'], Auth::user()->getPermissions() )
            )
            {
                return redirect()->route( 'dashboard' )->with( 'error', 'You have not access to this page.' );
            }

        }

        if ( Route::currentRouteName() !== 'dashboard.myaccount' && Route::currentRouteName() !== 'dashboard.myaccount.changepass' && Session::has('ResetPassword') && Session::get('ResetPassword') )
        {
            return redirect('/dashboard/my-account#change-password')->with( 'message', ['type' => 'danger', 'body' => 'Please update your password.'] );
        }

        return $next( $request );
    }

}
