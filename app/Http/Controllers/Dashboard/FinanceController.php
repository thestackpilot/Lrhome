<?php

namespace App\Http\Controllers\Dashboard;

use View;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PaytraceController;
use App\Http\Controllers\Dashboard\DashboardController;

class FinanceController extends DashboardController
{
    public function __construct()
    {
        parent::__construct();
        $this->paytrace = $this->active_theme_json->general->payment_method->enabled ? new PaytraceController() : '';
    }

    public function payment_options( Request $request )
    {
        $payments_enabled = false;
        $active_customer  = $request->has( 'customer' ) ? $request->customer : ( new Cart() )->get_active_cart_customer();
        $customers        = $this->get_customers_dropdown_options( false );

        if ( ! $active_customer && count( $customers ) > 1 )
        {
            $active_customer = $customers[0]['value'];
        }
        else

        if ( ! $active_customer && ! Auth::user()->is_sale_rep )
        {
            $active_customer = Auth::user()->customer_id;
        }

        View::share( 'active_customer', $active_customer );
        View::share( 'customers', $customers );

        if (
            $this->active_theme_json->general->payment_method->enabled &&
            $this->active_theme_json->general->payment_method->gateway == 'paytrace'
        )
        {
            $customer_payment_options = $this->paytrace->get_customer( $active_customer );
            $payments_enabled         = true;
            View::share( 'customer_payment_options', $customer_payment_options );
        }

        View::share( 'payments_enabled', $payments_enabled );
        View::share( 'card_required', 'data-required=true' );

        return view( 'dashboard.payment-options' );
    }

    public function save_payment_options( Request $request )
    {

        if ( $request->all() )
        {
            $validated_data = $request->validate( [
                'customer'        => 'required',
                'ccNumber'        => 'required',
                'ccExpiry'        => 'required',
                'ccCSC'           => 'required',
                'billing_address' => 'required',
                'submit'          => 'required'
            ] );

            $response = [];

            switch ( $validated_data['submit'] )
            {
                case 'update':
                    $response = $this->paytrace->update_customer( $validated_data['customer'], $validated_data );
                    break;
                case 'create':
                    $response = $this->paytrace->create_customer( $validated_data['customer'], $validated_data );
                    break;
            }

            if ( $response )
            {
                $message = $response['status_message'];

                if ( isset( $response['errors'] ) && $response['errors'] )
                {
                    $message .= "Following are the details:";

                    foreach ( $response['errors'] as $error )
                    {
                        $message .= "<br/> - {$error[0]}";
                    }

                }

                return redirect()->route( 'dashboard.paymentoptions' )->with( 'message', ['type' => $response['success'] ? 'success' : 'danger', 'body' => $message] );
            }
            else
            {
                return redirect()->route( 'dashboard.paymentoptions' )->with( 'message', ['type' => 'danger', 'body' => 'Something went wrong, please try again.'] );
            }

        }

        return redirect()->route( 'dashboard.paymentoptions' )->with( 'message', ['type' => 'danger', 'body' => 'Invalid request submitted.'] );

    }

}
