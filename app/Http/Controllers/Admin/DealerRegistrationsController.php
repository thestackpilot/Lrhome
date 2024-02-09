<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\ApisController;
use App\Http\Controllers\Admin\AdminController;

class DealerRegistrationsController extends AdminController
{
    public $pages, $customRoutes;

    public function __construct()
    {
        $this->ApiObj = new ApisController();
        parent::__construct();
    }

    public function index()
    {
        $dealers = User::query()->where( ['is_active' => 0, 'deleted_at' => null] )
            ->orderBy( 'created_at', 'DESC' )
            ->paginate( 50 );

        return view( 'admin.dealers', ['dealers' => $dealers, 'active_theme' => $this->active_theme_json] );
    }

    public function process_dealer_registration( Request $request )
    {

        $validated_data = $request->validate( [
            'dealer' => 'required',
            'submit' => 'required'
        ] );

        $dealer = ( new User() )->get_user( 'id', $validated_data['dealer'] );

        if ( $dealer )
        {

            switch ( $validated_data['submit'] )
            {
                case 'decline':
                    ( new User() )->delete_user( $dealer->id );

                    return redirect()->route( 'admin.dealer-registrations' )->with( 'message', ['type' => 'success', 'body' => 'Dealer registration request declined.'] );
                    break;
                case 'approve':
                    $response = [
                        'success' => 0,
                        'msg'     => 'Sorry something went wrong...'
                    ];

                    $result = $this->ApiObj->Create_DealerAccount(
                        '',
                        $dealer->getDataAttribute( 'email' ),
                        $dealer->getDataAttribute( 'firstname' ),
                        $dealer->getDataAttribute( 'lastname' ),
                        Crypt::decryptString( $dealer->getDataAttribute( 'password' ) ),
                        $dealer->getDataAttribute( 'company' ),
                        $dealer->getDataAttribute( 'postal_code' ),
                        $dealer->getDataAttribute( 'city' ),
                        $dealer->getDataAttribute( 'country' ),
                        $dealer->getDataAttribute( 'state' ),
                        $dealer->getDataAttribute( 'interested-in' ),
                        $dealer->getDataAttribute( 'phone' ),
                        ''
                    );

                    if ( isset( $result['Success'] ) && $result['Success'] )
                    {
                        ( new User() )->update_user( ['is_active' => 1], $validated_data['dealer'] );
                        $response['success'] = 1;
                        $response['msg']     = $result['Message'];
                    }
                    else
                    {
                        $response['success'] = 0;
                        $response['msg']     = $result['Message'];
                    }

                    return redirect()->route( 'admin.dealer-registrations' )->with( 'message', ['type' => $response['success'] ? 'success' : 'danger', 'body' => $response['msg']] );
                    break;
                default:
                    return redirect()->route( 'admin.dealer-registrations' )->with( 'message', ['type' => 'danger', 'body' => 'Invalid action...'] );
                    break;
            }

        }

        return redirect()->route( 'admin.dealer-registrations' )->with( 'message', ['type' => 'danger', 'body' => 'Something went wrong, please try again...'] );
    }

}
