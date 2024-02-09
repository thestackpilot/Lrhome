<?php

namespace App\Http\Controllers\Dashboard;

use View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Dashboard\DashboardController;

class ShippingController extends DashboardController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function freight_estimator( Request $request )
    {

        if ( count( $request->all() ) > 0 )
        {
            $meta_array = $this->convert_form_data_into_array( array( 'ItemID' => $request->item_id, 'Qty' => $request->quantity, 'Price' => $request->price ) );
            $freights   = $this->ApiObj->Get_ShippingRates( $request->customer_id, $request->ship_via_id, $meta_array );
            prr( $freights );

            $table = array( 'thead' => [
                'ship_id'   => 'Ship ID',
                'ship_name' => 'Ship Name',
                'rate'      => 'Rate'
            ], 'tbody' => [] );

            if ( isset( $freights['ShippingRates'] ) )
            {

                foreach ( $freights['ShippingRates'] as $freight )
                {
                    $table['tbody'][] = [
                        'ship_id'   => $freight['ShipViaID'],
                        'ship_name' => $freight['ShipViaName'],
                        'rate'      => $freight['Rate']

                    ];
                }

            }

            View::share( 'freights', $freights );
            View::share( 'table', $table );
        }

        $shippings = $this->ApiObj->Get_ShipViaList();

        if ( $shippings )
        {
            $temp = [];

            foreach ( $shippings['ShipVias'] as $shipping )
            {
                $temp[$shipping['Description']] = $shipping;
            }

            ksort( $temp );
            $shippings['ShipVias'] = $temp;
        }

        View::share( 'shippings', $shippings ? $shippings['ShipVias'] : [] );
        View::share( 'customers', Auth::user()->is_customer ? [['label' => Auth::user()->customer_id, 'value' => Auth::user()->customer_id]] : $this->get_customers_dropdown_options( 0 ) );
        
        session()->flashInput($request->input());
        return view( 'dashboard.freight-estimator' );
    }

}
