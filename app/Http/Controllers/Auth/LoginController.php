<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ApisController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\ConstantsController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;

class LoginController extends AuthController
{
    use AuthenticatesUsers;

    public function __construct()
    {
        parent::__construct();
        $this->middleware( 'guest' )->except( 'logout' );
        $this->ApiObj = new ApisController();
        $this->model  = new User();
    }

    public function authenticate( Request $request, $force_spars = 0, $ajax = 0 )
    {
        $credentials = $request->only( 'email', 'password' );

        if ( $force_spars )
        {

            $response = $this->authenticate_spars( $credentials );
            if ( !$response['success'] )
            {

//TODO : on login page is not redirecting

//TODO : The login / register page needs to be fixed as per LR
//TODO : The ajax login modal needs to be checked

                return ( $ajax ) ? response()->json( array( 'success' => 0, 'message' => $response['message'] ), 200 ) : redirect()->back()->withInput()->with( 'message', ['type' => 'danger', 'referer' => 'login', 'body' => $response['message']] );
            }

        }

        $loggedin = false;

        if (
            Auth::attempt( $credentials ) ||
            Auth::attempt( ['uuid' => $credentials['email'], 'password' => $credentials['password']] )
        )
        {
            prr( ' :: STAFF | ADMIN - USER :: ' );
            $loggedin = true;
        }
        else
        {
            $user = $this->model->get_user( '', '', ['customer_id' => $credentials['email'], 'parent_id' => null] );
            if ( $user )
            {
                prr( [' :: CUSTOMER - USER :: ' => $user->id] );
                $loggedin = Auth::loginUsingId( $user->id );
            }

        }

        if ( $loggedin && Auth::user()->is_active == 1 )
        {

            if ( Auth::user()->role == ConstantsController::USER_ROLES['admin'] )
            {
                return ( $ajax ) ? response()->json( array( 'success' => 1, 'message' => "The Login attempt was successful." ), 200 ) : Redirect::route( 'admin.basic_settings' );
            }
            else

            if ( Session::has('ResetPassword') && Session::get('ResetPassword') )
            {
                return ( $ajax ) ? response()->json( array( 'success' => 1, 'ResetPassword' => Session::get('ResetPassword'), 'message' => "The ResetPassword is enabled." ), 200 ) : redirect('/dashboard/my-account#change-password')->with( 'message', ['type' => 'danger', 'body' => 'Please update your password.'] );
            }

            if ( Auth::user()->is_sale_rep == 1 )
            {

                if ( $ajax )
                {

// TODO : The reponse object and the redirect object are just not taking the response back and seems like that we have included one view into another
// - that is the only thing that comes into mind - Adil needs to review this
                    return response()->json( array( 'success' => 1, 'message' => "The Login attempt was successful." ), 200 );
                }
                else
                {
                    return redirect()->route( 'frontend.home' );
                }

                return ( $ajax ) ? response()->json( array( 'success' => 1, 'message' => "The Login attempt was successful." ), 200 ) : Redirect::route( 'frontend.home' );
            }
            else
            {
                return ( $ajax ) ? response()->json( array( 'success' => 1, 'message' => "The Login attempt was successful." ), 200 ) : Redirect::route( 'frontend.home' );
            }

        }
        else
        {
            return ( $ajax ) ? response()->json( array( 'success' => 0, 'message' => "Login attempt has failed. Please re-check your user id / password and try again." ), 200 ) : redirect()->back()->withInput()->with( 'message', ['type' => 'danger', 'referer' => 'login', 'body' => 'Something went wrong please try again later, or reach out to us for further assistance...'] );
        }

    }

    public function authenticate_ajax( Request $request )
    {
        return $this->authenticate( $request, 1, 1 );
    }

    public function authenticate_normal( Request $request )
    {
        return $this->authenticate( $request, 1, 0 );
    }

    public function authenticate_spars( $credentials )
    {

        if ( is_numeric( $credentials['email'] ) )
        {
            $user = $this->model->get_user( 'uuid', $credentials['email'] );
        }
        else
        {
            $user = $this->model->get_user( 'email', $credentials['email'] );
        }

        if ( ! $user || ( $user && ($user->is_customer || $user->is_sale_rep) && ! in_array( $user->role, [ConstantsController::USER_ROLES['admin'], ConstantsController::USER_ROLES['staff']] ) ) )
        {
            $response = $this->ApiObj->Login( $credentials['email'], $credentials['password'] );

            if ( $response['Success'] )
            {
                if ( isset($response['UserDetails']['Email']) && $response['UserDetails']['Email'] )
                {
                    $user = $this->model->get_user( '', '', ['email' => $credentials['email'], 'parent_id' => null] );
		    if (!$user) $user = $this->model->get_user( '', '', ['customer_id' => $credentials['email'], 'parent_id' => null] );
                }
                else
                {
                    $user = $this->model->get_user( '', '', ['customer_id' => $credentials['email'], 'parent_id' => null] );
                }

                $data = [
                    'customer_id'         => $response['UserDetails']['UserID'],
                    'spars_id'            => $response['UserDetails']['SparsID'],
                    'sales_rep_customers' => json_encode( $response['UserDetails']['SalesRepCustomers'] ),
                    'is_customer'         => $response['UserDetails']['IsCustomer'],
                    'is_sale_rep'         => $response['UserDetails']['IsSalesRep'],
                    'password'            => Hash::make( $credentials['password'] ),
	             'email'          => $response['UserDetails']['Email'] ? $response['UserDetails']['Email'] : null,
                ];

                if ( isset($response['UserDetails']['ResetPassword']) && $response['UserDetails']['ResetPassword'] )
                {
                    Session::put('ResetPassword', $response['UserDetails']['ResetPassword']);
                }

                if ( $user )
                {
                    $this->model->update_user( $data, $user->id );
                }
                else
                {
                    $data = array_merge( $data, [
                        'firstname'      => $response['UserDetails']['FirstName'],
                        'lastname'       => $response['UserDetails']['LastName'],
                        'email'          => $response['UserDetails']['Email'] ? $response['UserDetails']['Email'] : null,
                        'password'       => Hash::make( $credentials['password'] ),
                        'company'        => $response['UserDetails']['Company'],
                        'street_address' => $response['UserDetails']['StreetAddress'],
                        'postal_code'    => $response['UserDetails']['PostalCode'],
                        'city'           => $response['UserDetails']['City'],
                        'country'        => $response['UserDetails']['Country'],
                        'state'          => $response['UserDetails']['State'],
                        'is_active'      => 1,
                        'phone'          => $response['UserDetails']['PhoneNo']
                    ] );

                    if ( ! strlen( trim( $data['email'] ) ) )
                    {
                        $data['email'] = null;
                        $this->model->add_user( $data );
                    }
                    else
                    {
                        $user = $this->model->get_user( 'email', $data['email'] );

                        if ( $user )
                        {
                            $data['email'] = join( '+'.time().'@', explode( '@', $data['email'] ) );
                        }

                        $this->model->add_user( $data );
                    }

                }

                return ['success' => true];
            }
            else
            {
                return ['success' => false, 'message' => $response['Message']];
            }

        }
        else
        {

            if ( $user && $user->role == ConstantsController::USER_ROLES['staff'] && $user->getDataAttribute( 'status' ) != 'active' )
            {
                return ['success' => false, 'message' => 'User is not available.'];
            }

        }

        return ['success' => true];
    }

    public function forgot_password( Request $request )
    {
        $validated_data = $request->validate( [
            'email'  => 'required|email|max:50'
        ] );

        $response = $this->ApiObj->ForgotPassword( $validated_data['email'] );

        return ( $response['Success'] ) ? redirect()->back()->withInput()->with( 'message', ['type' => 'success', 'referer' => 'login', 'body' => 'Password reset email has been sent to your email.'] ) : redirect()->back()->withInput()->with( 'message', ['type' => 'danger', 'referer' => 'login', 'body' => 'Something went wrong.'] );
    }

    public function login( Request $request )
    {
        }

    public function logout()
    {
        if ( Session::has( 'ResetPassword' ) && Session::get( 'ResetPassword' ) )
        {
            Session::forget( 'ResetPassword' );
        }
        
        Auth::logout();

        return redirect()->back(); // Redirect::route( 'auth.login' );
    }

}
