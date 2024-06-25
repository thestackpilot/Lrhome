<?php

namespace App\Http\Controllers\Dashboard;

use View;
use App\Jobs\SendMail;
use App\Models\OrderPayments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\ConstantsController;

class ShopController extends DashboardController
{
    public function __construct()
    {
        parent::__construct();
        $this->order_payment_model = new OrderPayments();
    }

    public function express_order( Request $request )
    {

        if ( count( $request->all() ) > 0 )
        {
            $meta_array   = $this->convert_form_data_into_array( array( 'ItemID' => $request->ItemID, 'OrderQty' => $request->OrderQty, 'UnitPrice' => $request->UnitPrice ) );
            $place_orders = $this->ApiObj->Place_Order( $request->customer_id, $request->customer_po, $request->order_date, $request->shipment_id, $request->first_name, $request->last_name, $request->email, $request->address1, $request->address2, $request->city, $request->state, $request->postal_code, '', $meta_array );

            $table = array( 'thead' => [
                'success_response' => 'Success',
                'Message'          => 'Message'
            ], 'tbody' => [] );

            if ( isset( $place_orders['Message'] ) )
            {
                $table['tbody'][] = [
                    'success_response' => $place_orders['Success'],
                    'Message'          => $place_orders['Message']

                ];
            }

            View::share( 'place_orders', $place_orders );
            View::share( 'table', $table );
        }

        return view( 'dashboard.ExpressOrder' );
    }

    public function get_design_items( Request $request )
    {

        if ( $request->all() )
        {
            if ( $request->DesignID && $request->Customer )
            {
                $response = $this->ApiObj->Get_DesignsItemsList( $request->DesignID, $request->Customer );
            }

            return response()->json(
                array(
                    'success'  => 1,
                    'response' => $response['OutPut']
                ), 200 );
        }

        return response()->json(
            array(
                'success'  => 0,
            ), 404 );

    }

    public function get_additional_filters( Request $request )
    {

        if ( $request->all() )
        {

/*
if ( $request->FilterType && $request->Customer && $request->ProductType && $request->Collection && $request->Design && $request->Color && $request->Size )
{
$response = $this->ApiObj->Get_ItemsDetail( $request->Customer, $request->ProductType, $request->Collection, $request->Design, $request->Color, $request->Size );
}
else
{
$response = $this->ApiObj->Get_OrderInquiryData( $request->FilterType, $request->ProductType, $request->Collection, $request->Design, $request->Color, $request->Size );
}
 */

            if ( $request->FilterType && $request->Customer && $request->Category && $request->SubCategory && $request->Collection && $request->Design && $request->Color && $request->Size )
            {
                $response = $this->ApiObj->Get_ItemsPlaceOrderDetail( $request->Customer, $request->Category, $request->SubCategory, $request->Collection, $request->Design, $request->Color, $request->Size, $request->FillType );
            }
            else
            {
                $response = $this->ApiObj->Get_B2BOrderInquiryData( $request->FilterType, $request->Category, $request->SubCategory, $request->Collection, $request->Design, $request->Color, $request->Size );
            }

            return response()->json(
                array(
                    'success'  => 1,
                    'response' => $response['OutPut']
                ), 200 );
        }

    }

    public function get_customer_addresses( Request $request )
    {

        if ( isset( $request->customer ) && $request->customer )
        {
            $shipping_addresses = $this->ApiObj->Get_CustomerAddresses( $request->customer );

            if ( $shipping_addresses && $shipping_addresses['Success'] == true )
            {
                $shipping_addresses = $shipping_addresses['CustomerAddress'];

                return response()->json(
                    array(
                        'success'   => 1,
                        'addresses' => $shipping_addresses
                    ), 200 );
            }

        }

        return response()->json(
            array(
                'success'   => 0,
                'addresses' => []
            ), 200 );

    }

    public function init_return( Request $request )
    {

        if ( count( $request->all() ) > 0 )
        {
            $meta_array    = $this->convert_form_data_into_array( array( 'SalesInvoiceNo' => $request->SalesInvoiceNo, 'ItemID' => $request->ItemID, 'Reason' => $request->Reason, 'ReturnQuantity' => $request->ReturnQuantity, 'LineNo' => $request->LineNo ) );
            $rmas_generate = $this->ApiObj->Get_RMA_Generated( $request->customer_id, $request->requested_by, $meta_array );
            prr( $rmas_generate );

            if ( isset( $rmas_generate['Success'] ) && $rmas_generate['Success'] )
            {
                return redirect()->back()->withInput()->with( 'message', ['type' => 'success', 'body' => isset( $rmas_generate['Message'] ) && $rmas_generate['Message'] ? $rmas_generate['Message'] : 'Operation Successfull!'] );
            }
            else
            {
                return redirect()->back()->withInput()->with( 'message', ['type' => 'danger', 'body' => isset( $rmas_generate['Message'] ) && $rmas_generate['Message'] ? $rmas_generate['Message'] : 'Something went wrong, please try again.'] );
            }

            $table = array( 'thead' => [
                'rma_number'       => 'Rma Number',
                'success_response' => 'Success',
                'Message'          => 'Message'
            ], 'tbody' => [] );

            if ( isset( $rmas_generate['Message'] ) )
            {
                $table['tbody'][] = [
                    'rma_number'       => $rmas_generate['RMANo'],
                    'success_response' => $rmas_generate['Success'],
                    'Message'          => $rmas_generate['Message']
                ];
            }

            View::share( 'rmas_generate', $rmas_generate );
            View::share( 'table', $table );
        }

        $reasons = $this->ApiObj->Get_ReturnReasonList();
        View::share( 'reasons', $reasons ? $reasons['ReturnReasons'] : [] );
        View::share( 'customers', Auth::user()->is_customer ? [[
            'value' => Auth::user()->customer_id, 'label' => Auth::user()->customer_id
        ]] : $this->get_customers_dropdown_options( 0 ) );

        return view( 'dashboard.init-return' );
    }

    public function place_order( Request $request )
    {

        if ( count( $request->all() ) > 0 )
        {
            $meta_array = $this->convert_form_data_into_array(
                array( 'ItemID' => $request->ItemID, 'OrderQty' => $request->OrderQty, 'MarkFor' => $request->MarkFor ) // , 'UnitPrice' => $request->UnitPrice )
            );

            $shipping_cost = 0;
            $details       = [];
            $cartItems     = [];
            $total_amount  = 0;

            $item_prices = $this->ApiObj->Get_GetMultipleItemsPrices( $request->customer_id, join( ',', $request->ItemID ) );

            if ( $item_prices['Success'] )
            {

                if ( count( $item_prices['ItemPrices'] ) != count( array_unique( $request->ItemID ) ) )
                {
                    $item_ids = [];

                    foreach ( $meta_array as $index )
                    {
                        $item_found = false;

                        foreach ( $item_prices['ItemPrices'] as $item )
                        {

                            if ( $index['ItemID'] == $item['ItemID'] )
                            {
                                $item_found = true;
                                break;
                            }

                        }

                        if ( ! $item_found )
                        {
                            $item_ids[] = $index['ItemID'];
                        }

                    }

                    if ( ! $item_ids )
                    {
                        $duplicate_items = [];

                        foreach ( $request->ItemID as $k => $item_id )
                        {
                            $key = md5( json_encode( [$item_id, $request->MarkFor[$k]] ) );

                            foreach ( $item_prices['ItemPrices'] as $item )
                            {

                                if ( $item_id == $item['ItemID'] )
                                {

                                    if ( array_key_exists( $key, $duplicate_items ) )
                                    {
                                        $duplicate_items[$key]++;
                                    }
                                    else
                                    {
                                        $duplicate_items[$key] = 1;
                                    }

                                    if ( $duplicate_items[$key] > 1 && ! in_array( $item_id, $item_ids ) )
                                    {
                                        $item_ids[] = $item_id;
                                    }

                                    break;
                                }

                            }

                        }

                        if ( $item_ids )
                        {
                            return redirect()->back()->withInput()->with( 'message', ['type' => 'danger', 'body' => 'Following item ids are repeated/duplicate : <br> <br> Item ID : '.join( '<br> Item ID : ', $item_ids ).' <br/> <br/> Please if you can cross check these and try again.'] );
                        }
                        else
                        {
                            return redirect()->back()->withInput()->with( 'message', ['type' => 'danger', 'body' => 'There seems to be an issue with the data, please if you can cross check these and try again.'] );
                        }

                    }
                    else
                    {
                        return redirect()->back()->withInput()->with( 'message', ['type' => 'danger', 'body' => 'Following item ids seems to be invalid since we were unable to fetch their prices : <br> <br> Item ID : '.join( '<br> Item ID : ', $item_ids ).' <br/> <br/> Please if you can cross check these and try again.'] );
                    }

                }
                else
                {
                    $allowed_item_quantities = [];
                    $non_web_rug_items       = [];
                    $item_quantities         = [];

                    foreach ( $request->ItemID as $k => $item_id )
                    {
                        $item_quantities[$item_id] = $request->OrderQty[$k];
                    }

                    foreach ( $item_prices['ItemPrices'] as $item )
                    {
                        $item_ASTQs[] = $item['ATSQ'];

                        foreach ( $meta_array as &$index )
                        {

                            if ( $index['ItemID'] == $item['ItemID'] )
                            {
                                $index['UnitPrice'] = $item['ItemPrice'];

                                if (
                                    (
                                        CommonController::check_bit_field( $item, 'Discontinued' ) ||
                                        CommonController::check_bit_field( $item, 'SpecialBuy' ) ||
                                        CommonController::check_bit_field( $item, 'Reviewed' )
                                    ) && ( isset( $item['ATSQ'] ) && $item['ATSQ'] < $item_quantities[$item['ItemID']] ) )
                                {
                                    $allowed_item_quantities[] = "{$item['ItemID']} has only {$item['ATSQ']} units available";
                                }

                                // break;
                            }

                        }

                        if ( ! CommonController::check_bit_field( $item, 'WEBRug' ) )
                        {
                            $non_web_rug_items[] = $item['ItemID'];
                        }

                        array_push( $details, [
                            'ItemID' => $item['ItemID'],
                            'Qty'    => $item_quantities[$item['ItemID']],
                            'Price'  => $item['ItemPrice']
                        ] );

                        array_push( $cartItems, [
                            'Image'     => CommonController::getApiFullImage( str_replace(' ', '%20', $item['ImageName']) ),
                            'ItemID'    => $item['ItemID'],
                            'Color'     => $item['ColorDescription'],
                            'Size'      => $item['SizeDescription'],
                            'OrderQty'  => $item_quantities[$item['ItemID']],
                            'UnitPrice' => number_format( $item['ItemPrice'], ConstantsController::ALLOWED_DECIMALS, '.', ',' ),
                            'SubTotal'  => number_format( $item['ItemPrice'] * $item_quantities[$item['ItemID']], ConstantsController::ALLOWED_DECIMALS, '.', ',' ),
                            'MarkFor'   => isset( $requestDataArray['sidemark'] ) && isset( $requestDataArray['sidemark'][$item['ItemID']] ) ? $requestDataArray['sidemark'][$item['ItemID']] : ''
                        ]);

                    }

// when WEBRug is False then show message.
                    if ( $non_web_rug_items )
                    {
                        return redirect()->back()->withInput()->with( 'message', ['type' => 'danger', 'body' => 'Following Items: <br><br> Item ID : '.join( '<br> Item ID : ', $non_web_rug_items ).' <br> <br> are not marked as webrugs please make the correction before proceeding ahead.'] );
                    }

                    if ( $allowed_item_quantities )
                    {
                        return redirect()->back()->withInput()->with( 'message', ['type' => 'danger', 'body' => join( '<br>', $allowed_item_quantities ).' <br> <br> Please order the correct quantities.'] );
                    }

                    $shipping_rate_response = $this->ApiObj->Get_Shipping_Rates( $request->customer_id, $request->ship_via_id, $details );
                    if ( $shipping_rate_response['Success'] == 1 )
                    {
                        $shipping_cost = $shipping_rate_response['ShippingRates'][0]['Rate'];
                    }

                }

            }
            else
            {
                return redirect()->back()->withInput()->with( 'message', ['type' => 'danger', 'body' => $item_prices['Message'].'<br>'.join( '<br>', array_unique( $request->ItemID ) )] );
            }

            $headers = [
                'CustomerID'   => $request->customer_id,
                'CustomerPO'   => $request->customer_po,
                'OrderDate'    => date( "Y-m-d", strtotime( $request->order_date ) ),
                'FirstName'    => $request->first_name,
                'LastName'     => $request->last_name,
                'Email'        => $request->email,
                'Address1'     => $request->address1,
                'Address2'     => $request->address2,
                'City'         => $request->city,
                'Country'      => $request->country,
                'State'        => $request->state,
                'Zip'          => $request->postal_code,
                'ShipViaCode'  => $request->ship_via_id,
                'ShippingCost' => $shipping_cost,
                'AddressType'  => 'RESIDENTIAL' // if dropship
            ];

            if ( isset( $request->address_id ) && $request->address_id )
            {
                $headers['ShipToCode']  = $request->address_id;
                $headers['AddressType'] = 'COMMERCIAL'; // if selected a given address
            }

            if ( isset( $request->req_ship_date ) && $request->req_ship_date )
            {
                $headers['ShipDate']     = date( 'Y-m-d', strtotime( $request->req_ship_date ) );
                $headers['DeliveryTime'] = date( 'H:i:s', strtotime( $request->req_ship_date ) );
            }

            foreach( $cartItems as $item )
            {
                $total_amount += $item['SubTotal'];
            }

            $order_payment_hash             = md5( json_encode( ['general' => $headers, 'items' => $meta_array] ) );
            $headers['IsAdvancePayment']    = false;
            $headers['AdvancePaymentAmout'] = 0;
            $headers['TransactionCode']     = '';

            $order_payment = $this->order_payment_model->updateOrCreate(
                ['user_id' => Auth::user()->id, 'hash' => $order_payment_hash],
                [
                    'user_id'      => Auth::user()->id,
                    'hash'         => $order_payment_hash,
                    'order_data'   => serialize( [$headers, $meta_array] ),
                    'order_status' => ConstantsController::ORDER_STATUS['not-applicable']
                ]
            );

            $place_orders = $this->ApiObj->Place_Order(
                $headers,
                $meta_array
            );

            $order_payment = $this->order_payment_model->updateOrCreate(
                ['user_id' => Auth::user()->id, 'hash' => $order_payment_hash],
                [
                    'order_response' => json_encode( $place_orders ),
                    'order_status'   => ConstantsController::ORDER_STATUS['processed']
                ]
            );

            $table = array( 'thead' => [
                'Message' => 'Message'
            ], 'tbody' => [] );

            if ( isset( $place_orders['Message'] ) )
            {
                $message = $place_orders['Message'];

                if ( isset( $place_orders['ErrorDetail'] ) && $place_orders['ErrorDetail'] )
                {
                    $message .= ", following are the details:";

                    foreach ( $place_orders['ErrorDetail'] as $i => $error )
                    {
                        $message .= "<br/>".( $i + 1 ).": {$error['ErrorDescription']}<br/>";
                    }

                }

                $table['tbody'][] = [
                    'Message' => $message
                ];
            }

            if ( isset( $place_orders['Success'] ) && $place_orders['Success'] )
            {

                $order_payment = $this->order_payment_model->updateOrCreate(
                    ['user_id' => Auth::user()->id, 'hash' => $order_payment_hash],
                    [
                        'hash' => md5( json_encode( ['general' => $headers, 'items' => $meta_array, 'status' => ConstantsController::ORDER_STATUS['done']] ) ), // update this hash to avoid any repeating order to be caught by this
                        'order_status' => ConstantsController::ORDER_STATUS['done']
                    ]
                );

//                if ( isset($this->active_theme_json->general->order_ack) && $this->active_theme_json->general->order_ack ) {
                    $cart_data = [
                        'shipping' => $headers,
                        'items'    => $cartItems,
                        'total'    => number_format( $total_amount, ConstantsController::ALLOWED_DECIMALS, '.', ',' )
                    ];

                    if(array_key_exists('Instructions',$cart_data['shipping']) == false){
                        $cart_data['shipping']['Instructions'] = $request->shipping_instructions;
                    }

                    $cart_data['shipping']['SO_Number'] = $place_orders['ObjectID'];

                    try {

                        $to_email = ConstantsController::ORDER_NOTIFICATION;

                        if(isset($headers['Email']) && $headers['Email'] != ''){
                            array_push($to_email, $headers['Email']);
                        }

                        SendMail::dispatch( [
                            'data'     => $cart_data,
                            'slug'     => "Thank you: Order# " . $place_orders['ObjectID'],
                            'email'    => $to_email,
                            'template' => 'email.order-confirmation',
                            'cc_email' => Auth::user()->is_sale_rep ? (isset(Auth::user()->email) ? Auth::user()->email : '') : ''
                        ] );

                        prr( " :: Order Placement Email Sent :: " );
                    }
                    catch ( \Exception $e )
                    {
                        prr( "Order Placement Email Exception :: ".$e->getMessage() );
                    }
//                }

                return redirect()->back()->with( 'message', ['type' => 'success', 'body' => $message] );
            }
            else
            {
                $order_payment = $this->order_payment_model->updateOrCreate(
                    ['user_id' => Auth::user()->id, 'hash' => $order_payment_hash],
                    [
                        'order_status' => ConstantsController::ORDER_STATUS['failed']
                    ]
                );

                return redirect()->back()->withInput()->with( 'message', ['type' => 'danger', 'body' => $message] );
            }

            View::share( 'place_orders', $place_orders );
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

        $ship_vias = [];

        if ( $shippings && isset( $shippings['ShipVias'] ) )
        {

            foreach ( $shippings['ShipVias'] as $ship_via )
            {
                $ship_vias[] = [
                    'value' => $ship_via['ShipViaID'],
                    'label' => $ship_via['ShipViaID']." - ".$ship_via['Description']
                ];
            }

        }

        $default_ship_via_id = '';

        if ( $request->ship_via_id || old( 'ship_via_id' ) )
        {
            $default_ship_via_id = $request->ship_via_id || old( 'ship_via_id' );
        }
        else
        {
            $shipping_options = $this->ApiObj->Get_Shipping_Options( Auth::user()->customer_id );

            if ( $shipping_options && $shipping_options['Success'] == true )
            {
                $default_ship_via_id = $shipping_options['CustomerShipVias'][0]['ShipViaID'];
            }

        }

        $countries = $states = [];
        /*
        $countries  = $this->ApiObj->Get_CountriesList();
        $country_id = 0;

        foreach ( $countries['Countries'] as $country )
        {

        if ( $country['OriginCode'] == 'US' )
        {
        $country_id = $country['CountryNo'];
        break;
        }

        }
        $states = $this->ApiObj->Get_CountryStates( $country_id );
         */
        View::share( 'countries', $countries );
        View::share( 'states', $states );

        $filters = [
            [
                'title'       => 'Customer ID',
                'type'        => Auth::user()->is_customer ? 'hidden' : 'select',
                'options'     => $this->get_customers_dropdown_options( 0 ),
                'placeholder' => '',
                'value'       => $request->customer_id ? $request->customer_id : Auth::user()->customer_id
            ],
            [
                'title'       => 'Customer PO',
                'type'        => 'text',
                'placeholder' => '',
                'attribues'   => ' data-required="true" maxlength="250" ',
                'value'       => $request->customer_po
            ],
            [
                'title'       => 'Order Date',
                'type'        => 'text',
                'placeholder' => '',
                'attribues'   => ' data-required="true" readonly="readonly"',
                'value'       => $request->order_date ? CommonController::get_date_format( $request->order_date ) : CommonController::get_date_format( date( 'Y-m-d' ) )
            ],
            [
                'title'       => 'Req Ship Date',
                'type'        => 'date',
                'class'       => 'datepicker',
                'placeholder' => '',
                'attribues'   => ' data-required="true" ',
                'value'       => $request->req_ship_date ? CommonController::get_date_format( $request->req_ship_date ) : CommonController::get_date_format( date( 'Y-m-d' ) )
            ],
            [
                'title'       => 'Ship Via ID',
                'type'        => 'select',
                'placeholder' => '',
                'attribues'   => ' data-required="true" ',
                'options'     => $ship_vias,
                'value'       => $default_ship_via_id
            ]
        ];

        View::share( 'datepicker_dates', ['min' => 'today', 'max' => '+1m'] );
        View::share( 'filters', $filters );

        // $all_design = $this->ApiObj->Get_AllDesign();
        $all_design = $this->ApiObj->B2B_GetAllItemsList();
        View::share( 'all_designs', isset($all_design['Success']) && $all_design['Success'] ? $all_design['DesignList'] : [] );

        return view( 'dashboard.place-order' );

    }

    public function view_order( Request $request )
    {

        if ( count( $request->all() ) > 0 )
        {
            $view_orders = $this->ApiObj->View_Order( $request->customer_id, $request->external_id, $request->date_from, $request->date_to, $request->sales_rep );
            prr( $view_orders );

            $table = array( 'thead' => [
                'order_no'     => 'RMA Number',
                'customer_id'  => 'Customer ID',
                'customer_po'  => 'Customer PO',
                'total_Amount' => 'Amount',
                'status'       => 'Status',
                'order_date'   => 'Order Date',
                'actions'      => 'Actions'
            ], 'tbody' => [] );

            if ( isset( $view_orders['Orders'] ) )
            {

                foreach ( $view_orders['Orders'] as $view_order )
                {
                    $table['tbody'][] = [
                        'order_no'     => $view_order['Header']['OrderNo'],
                        'customer_id'  => $view_order['Header']['CustomerID'],
                        'customer_po'  => $view_order['Header']['CustomerPO'],
                        'total_Amount' => $view_order['Header']['TotalAmount'],
                        'status'       => $view_order['Header']['Status'],
                        'order_date'   => isset( $view_order['Header']['OrderDate'] ) ? $view_order['Header']['OrderDate'] : 'N/A',
                        'actions'      => [['type' => 'modal', 'label' => 'View Details']],
                        'details'      => [
                            'heading' => $view_order['Header']['OrderNo'].' : '.$view_order['Header']['CustomerID'],
                            'body'    => [
                                'sections' => [
                                    [
                                        'title'   => 'Detail',
                                        'content' => $view_order['Detail']
                                    ]
                                ]
                            ]
                        ]
                    ];
                }

            }

            View::share( 'view_orders', $view_orders );
            View::share( 'table', $table );

        }

        $filters = [
            [
                'title'       => 'From Date',
                'type'        => 'date',
                'attribues'   => ' data-required="true" ',
                'placeholder' => '',
                'value'       => ''
            ],
            [
                'title'       => 'To Date',
                'type'        => 'date',
                'attribues'   => ' data-required="true" ',
                'placeholder' => '',
                'value'       => ''
            ],
            [
                'title'       => 'Customer',
                'type'        => Auth::user()->is_customer ? 'hidden' : 'select',
                'options'     => $this->get_customers_dropdown_options(),
                'placeholder' => '',
                'value'       => Auth::user()->customer_id
            ],
            [
                'title'       => 'External Number',
                'type'        => 'text',
                'placeholder' => '',
                'value'       => ''
            ]
        ];

        View::share( 'filters', $filters );

        return view( 'dashboard.generic-report' );

    }

}
