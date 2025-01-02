<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use View;
use Session;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\Dashboard\DashboardController;

class AccountController extends DashboardController
{
    public function __construct()
    {
        parent::__construct();
        $this->user_model = new User();
    }

    public function account_information( Request $request )
    {
        $active_customer    = $request->has('customer') ? $request->customer : ( new Cart() )->get_active_cart_customer();
        $shipping_addresses = $parent = array();

        if ( Auth::user()->parent_id )
        {
            $parent = $this->user_model->get_user( 'parent_id', Auth::user()->parent_id );
        }

        if ( $active_customer )
        {
            $shipping_addresses = $this->ApiObj->Get_CustomerAddresses( $active_customer );
        }

        return view( 'dashboard.account-information', [
            'customers'       => $this->get_customers_dropdown_options( 0 ),
            'client_address'  => $shipping_addresses,
            'active_customer' => $active_customer,
            'parent'          => $parent
        ] );
    }

    public function account_update( Request $request )
    {

        switch ( $request->get( 'form-type' ) )
        {
            case ConstantsController::FORM_TYPES['profile']:
                return $this->update_account_general_information( $request );
                break;
            case ConstantsController::FORM_TYPES['update-cost']:
                return $this->update_account_cost_settings( $request );
                break;
            case ConstantsController::FORM_TYPES['update-cost-toggle']:
                return $this->update_account_cost_toggle_settings( $request );
                break;
            case ConstantsController::FORM_TYPES['update-freight']:
                return $this->update_account_freight_settings( $request );
                break;
        }

        return redirect()->route( 'dashboard.myaccount' )->with( 'message', ['type' => 'error', 'body' => 'Invalid request...'] );
    }

    public function change_password( Request $request )
    {
        $validated_data = $request->validate( [
            'existing-password' => 'required',
            'new-password'      => 'required|min:8|max:12',
            'confirm-password'  => 'required|min:8|max:12'
        ] );

        if ( isset( Auth::user()->email ) && Auth::user()->email )
        {
            prr( Auth::user()->email );
            if ( ! Auth::attempt( ['email' => Auth::user()->email, 'password' => $validated_data['existing-password']] ) )
            {
                return redirect()->back()->withInput()->with( 'message', ['type' => 'danger', 'referer' => 'changepass', 'body' => 'Wrong details for existing password.'] );
            }

        }
        else
        {
            prr( Auth::user()->customer_id );
            if ( ! Auth::attempt( ['customer_id' => Auth::user()->customer_id, 'password' => $validated_data['existing-password']] ) )
            {
                return redirect()->back()->withInput()->with( 'message', ['type' => 'danger', 'referer' => 'changepass', 'body' => 'Wrong details for existing password.'] );
            }

        }

        if ( $validated_data['new-password'] != $validated_data['confirm-password'] )
        {
            return redirect()->back()->withInput()->with( 'message', ['type' => 'danger', 'referer' => 'changepass', 'body' => 'New password and confirm password doesn\'t match.'] );
        }

        $data = [
            'password'   => Hash::make( $validated_data['new-password'] ),
            'updated_at' => date( 'Y-m-d H:i:s' )
        ];

        $updated_in_spars = true;

// TODO : When the password is updated then the SPARS call needs to be sent in order for the Spars to update it's password
        if ( Auth::user()->parent_id == 0 )
        {
            $api_response = $this->ApiObj->ChangePassword( Auth::user()->customer_id, $validated_data['existing-password'], $validated_data['new-password'] );
            if ( ! $api_response['Success'] )
            {
                $updated_in_spars = false;
            }

        }

        if ( $updated_in_spars )
        {
            if ( Session::has( 'ResetPassword' ) && Session::get( 'ResetPassword' ) )
            {
                Session::forget( 'ResetPassword' );
            }

            $this->user_model->update_user( $data, Auth::user()->id );

            // return redirect()->route( 'dashboard.myaccount' )->with( 'message', ['type' => 'success', 'body' => 'Password changed successfully...'] );
            Auth::logout();
        }

        return redirect()->back()->withInput()->with( 'message', ['type' => 'danger', 'referer' => 'changepass', 'body' => 'Somthing went wrong, please try again later...'] );

        // return redirect()->route( 'auth.login' )->with( 'message', ['type' => 'success', 'referer' => 'login', 'body' => 'Password changed successfully...'] );
    }

    public function dashboard()
    {
        $active_customer    = ( new Cart() )->get_active_cart_customer();
        $shipping_addresses = array();

        if ( $active_customer )
        {
            $shipping_addresses = $this->ApiObj->Get_CustomerAddresses( $active_customer );
            prr( $shipping_addresses );
        }

        // TODO - DATE NEEDS TO BE CHANGED
        $view_orders = $this->ApiObj->View_Order( Auth::user()->is_customer ? Auth::user()->customer_id : '', '', date( 'Y-m-d', strtotime( ' -1 year' ) ), date( 'Y-m-d' ), Auth::user()->is_sale_rep ? Auth::user()->customer_id : '' );
        $table       = array( 'thead' => [
            'order_no'     => 'Order Number',
            'customer_id'  => 'Customer ID',
            'customer_po'  => 'Customer PO',
            'total_Amount' => 'Total Amount',
            'total_qty'    => 'Total Quantity',
            'status'       => 'Status',
            'order_date'   => 'Order Date',
            'actions'      => 'Actions',
        ], 'tbody' => [] );

        if ( isset( $view_orders['Orders'] ) )
        {

            foreach ( $view_orders['Orders'] as $view_order )
            {
                if ( isset($this->active_theme_json->theme_slug) && $this->active_theme_json->theme_slug === 'lr' )
                {
                    foreach($view_order['Detail'] as $index => $view)
                    {
                        $column = CommonController::get_selected_columns($view, [
                            'ImageName', 'ItemID', 'ItemDescription', 'UnitPrice', 'OrderQty', 'Status', 'ShippedQty', 'ExtPrice', 'SideMark'
                        ]);
                        $column['href'] = route('frontend.item', [$view['Collection'], $view['DesignID']]);
                        $column['BackOrderQty'] = isset($view['BackOrder']) && CommonController::check_bit_field($view, 'BackOrder' ) ? ( (isset($view['ETADate']) ? 'ETA: ' . Carbon::parse($view['ETADate'])->format('M-d-Y') : '') . (isset($view['ETAQty']) ? ' <br>Qty: '. $view['ETAQty'] : '')) : '';
                        $view_order['Detail'][$index] = $column;
                        $view_order['Detail'][$index]['UnitPrice'] = ConstantsController::CURRENCY.number_format( $view['UnitPrice'], ConstantsController::ALLOWED_DECIMALS );
                        $view_order['Detail'][$index]['ExtPrice'] = ConstantsController::CURRENCY.number_format( $view['ExtPrice'], ConstantsController::ALLOWED_DECIMALS );
                    }

                    foreach($view_order['OrderTrackingDetail'] as $index => $view)
                    {
                        $column = CommonController::get_selected_columns($view, [
                            'ImageName', 'ItemID', 'SalesOrderNo', 'DateCreated', 'SalesInvoiceNo', 'TrackingNo'
                        ]);
                        $column['DateCreated'] = Carbon::parse($column['DateCreated'])->format('M-d-Y');
                        $view_order['OrderTrackingDetail'][$index] = $column;
                    }

                    foreach ($view_order['OrderInvoiceDetail'] as $index => $view) {
                        $view_order['OrderInvoiceDetail'][$index]['InvoiceDate'] = Carbon::parse($view['InvoiceDate'])->format('M-d-Y');
                        $view_order['OrderInvoiceDetail'][$index]['TotalAmount'] = ConstantsController::CURRENCY.number_format( $view['TotalAmount'], ConstantsController::ALLOWED_DECIMALS );
                    }
                }

                $customer_content =  [
                    'PO#'   => $view_order['Header']['CustomerPO'],
                    'ShipVia'       => $view_order['Header']['ShipViaCode'],
                    'OrderPlacedBy'   => $view_order['Header']['OrderTakenBy'],
                    'Rep' => $view_order['Header']['SalesRepID'] . ' ' . $view_order['Header']['AgentCompany'],
                    'CreatedBy' => $view_order['Header']['CreatedBy']
                ];

                if (!empty($view_order['Header']['SalesRepID'])) {
                    $customer_content['SpecialInstructions'] = $view_order['Header']['SpecialInstructions'];
                }

                if (!empty($view_order['Header']['SalesRepID'])) {
                    $customer_content['Notes'] = $view_order['Header']['Instructions'];
                }

                $bill_to_content = [
                    'First &LastName' => $view_order['Header']['BillingFirstName'] . ' ' . $view_order['Header']['BillingLastName'],
                    'StreetAddress1' => $view_order['Header']['BillingAddress1']
                ];

                if (!empty($view_order['Header']['BillingAddress2'])) {
                    $bill_to_content['StreetAddress2'] = $view_order['Header']['BillingAddress2'];
                }
                $bill_to_content['City,State,Zip'] = $view_order['Header']['BillingCity'] . ', ' . $view_order['Header']['BillingState']. ', ' . $view_order['Header']['BillingZipCode'];
                $bill_to_content['Country'] = $view_order['Header']['BillingCountry'];
                $bill_to_content['PhoneNumber'] = $view_order['Header']['BillingPhone1'];
                $bill_to_content['Email'] = $view_order['Header']['BillingEmail'];

                $ship_to_content = [
                    'First &LastName' => $view_order['Header']['ShippingFirstName'] . ' ' . $view_order['Header']['ShippingLastName'],
                    'StreetAddress1' => $view_order['Header']['ShippingAddress1']
                ];

                if (!empty($view_order['Header']['ShippingAddress2'])) {
                    $ship_to_content['StreetAddress2'] = $view_order['Header']['ShippingAddress2'];
                }
                $ship_to_content['City,State,Zip'] = ($view_order['Header']['ShippingCity'] ? $view_order['Header']['ShippingCity'] .', ': null) .$view_order['Header']['ShippingState']. ', ' . $view_order['Header']['ShippingZipCode'];
                $ship_to_content['Country'] = $view_order['Header']['ShippingCountry'];
                $ship_to_content['PhoneNumber'] = $view_order['Header']['ShippingPhone'];
                $ship_to_content['Email'] = $view_order['Header']['ShippingEmail'];

                $table['tbody'][] = [
                    'order_no'     => $view_order['Header']['OrderNo'],
                    'customer_id'  => $view_order['Header']['CustomerID'],
                    'customer_po'  => $view_order['Header']['CustomerPO'],
                    'total_Amount' => ConstantsController::CURRENCY.number_format( $view_order['Header']['TotalAmount'], ConstantsController::ALLOWED_DECIMALS ),
                    'total_qty'    => $view_order['Header']['TotalQty'],
                    'status'       => $view_order['Header']['Status'],
                    'tab'          => isset( $view_order['Header']['TabStatusDescription'] ) ? $view_order['Header']['TabStatusDescription'] : '',
                    'order_date'   => isset( $view_order['Header']['OrderDate'] ) ?  Carbon::parse($view_order['Header']['OrderDate'])->format('M d, Y') : 'N/A',
                    'actions'      => [['type' => 'modal', 'label' => 'View Details']],
                    'details'      => [
                        'heading' => $view_order['Header']['OrderNo'].' : '.$view_order['Header']['CustomerID'],
                        'body'    => [
                            'sections' => [
                                [
                                    'title'   => $view_order['Header']['CustomerID'] . ' ' . $view_order['Header']['CustomerName'],
                                    'content' => $customer_content,
                                    'cols' => 6
                                ],
                                [
                                    'title'   => preg_replace('/([a-z])([A-Z])/', '$1 $2', $view_order['Header']['TransactionType']) . '#: ' . $view_order['Header']['TransactionNo'],
                                    'content' => [
                                        'Status ' => $view_order['Header']['Status'],
                                        'OrderDate ' => Carbon::parse($view_order['Header']['OrderDate'])->format('M d, Y'),
                                        'ShipDate' => Carbon::parse($view_order['Header']['ShippingDate'])->format('M d, Y'),
                                        'Terms' => $view_order['Header']['PaymentTerm'],
                                        'TotalQty' => $view_order['Header']['TotalQty'],
                                        'MerchandiseTotal' =>  ConstantsController::CURRENCY.number_format( (float)$view_order['Header']['TotalMerchandise'] , ConstantsController::ALLOWED_DECIMALS ),
                                    ],
                                    'cols' => 6
                                ],
                                [
                                    'title'   => 'Bill To:',
                                    'content' => $bill_to_content,
                                    'cols' => 6,
                                    'hide_labels' => 1
                                ],
                                [
                                    'title'   => 'Ship To: ',
                                    'content' => $ship_to_content,
                                    'cols' => 6,
                                    'hide_labels' => 1
                                ],
                                [
                                    'title'   => 'Detail',
                                    'cols' => 12,
                                    'content' => isset( $view_order['Header']['TabStatusDescription'] ) ? [
                                        'tabs' => [
                                            'products' => $view_order['Detail'],
                                            'tracks'   => isset( $view_order['OrderTrackingDetail'] ) ? $view_order['OrderTrackingDetail'] : [],
                                            'invoices' => isset( $view_order['OrderInvoiceDetail'] ) ? $view_order['OrderInvoiceDetail'] : []
                                        ]
                                    ] : $view_order['Detail']
                                ]
                            ]
                        ]
                    ]
                ];
            }

        }

        View::share( 'view_orders', $view_orders );
        View::share( 'table', $table );
        // View::share( 'tabular', 'yes' );

        return view( 'dashboard.dashboard', ['client_address' => $shipping_addresses, 'active_customer' => $active_customer] );
    }

    public function document()
    {

        $documents = [
            [
                'title' => $this->pages->documents->sections->catalog->document_title_1,
                'link'  => $this->pages->documents->sections->catalog->document_url_1
            ],
            [
                'title' => $this->pages->documents->sections->catalog->document_title_2,
                'link'  => $this->pages->documents->sections->catalog->document_url_2
            ],
            [
                'title' => $this->pages->documents->sections->catalog->document_title_3,
                'link'  => $this->pages->documents->sections->catalog->document_url_3
            ],
            [
                'title' => $this->pages->documents->sections->catalog->document_title_4,
                'link'  => $this->pages->documents->sections->catalog->document_url_4
            ],
            [
                'title' => $this->pages->documents->sections->catalog->document_title_5,
                'link'  => $this->pages->documents->sections->catalog->document_url_5
            ]
        ];

        return view( 'dashboard.document', ['documents' => $documents] );
    }

    public function my_account()
    {
        return view( 'dashboard.my-account' );
    }

    public function update_account_cost_settings( $request )
    {
        $validated_data = $request->validate( [
            'cost-type'       => 'required|max:255',
            'msrp-multiplier' => 'required|max:255'
        ] );

        $user_data                    = (array) Auth::user()->parseDataAttribute();
        $user_data['cost-type']       = $validated_data['cost-type'];
        $user_data['msrp-multiplier'] = $validated_data['msrp-multiplier'];
        $data                         = [
            'data'       => serialize( json_encode( $user_data ) ),
            'updated_at' => date( 'Y-m-d H:i:s' )
        ];

        $this->user_model->update_user( $data, Auth::user()->id );

        return redirect()->route( 'dashboard.myaccount' )->with( 'message', ['type' => 'success', 'body' => 'Record updated...'] );
    }

    public function update_account_cost_toggle_settings( $request )
    {
        $validated_data = $request->validate( [
            'cost-type'       => 'required|max:255',
            'msrp-multiplier' => 'required|max:255'
        ] );

        $user_data                    = (array) Auth::user()->parseDataAttribute();
        $user_data['cost-type']       = $validated_data['cost-type'];
        $user_data['msrp-multiplier'] = $validated_data['msrp-multiplier'];
        $data                         = [
            'data'       => serialize( json_encode( $user_data ) ),
            'updated_at' => date( 'Y-m-d H:i:s' )
        ];

        $this->user_model->update_user( $data, Auth::user()->id );

        return redirect()->back()->with( 'message', ['type' => 'success', 'body' => 'Record updated...'] );
    }

    public function update_account_freight_settings( $request )
    {
        $validated_data = $request->validate( [
            'freight-percentage' => 'required|max:255'
        ] );

        $user_data                       = (array) Auth::user()->parseDataAttribute();
        $user_data['freight-percentage'] = $validated_data['freight-percentage'];
        $data                            = [
            'data'       => serialize( json_encode( $user_data ) ),
            'updated_at' => date( 'Y-m-d H:i:s' )
        ];

        $this->user_model->update_user( $data, Auth::user()->id );

        foreach ( $validated_data['freight-percentage'] as $customer_id => $percentage )
        {
            $shipping_addresses = $this->ApiObj->Update_ShippingFreightRate( Auth::user()->is_sale_rep ? Auth::user()->customer_id : 0, $customer_id, $percentage );
            prr( $shipping_addresses );
        }

        return redirect()->route( 'dashboard.myaccount' )->with( 'message', ['type' => 'success', 'body' => 'Record updated...'] );
    }

    public function update_account_general_information( $request )
    {
        $validator = Validator::make( $request->all(), [
            'firstname' => 'required|max:255',
            'lastname'  => 'required|max:255',
            'email'     => 'required|unique:users,email,'.Auth::user()->id
        ], [
            'firstname.required' => 'Couldn\'t update information, firstname is required.',
            'lastname.required'  => 'Couldn\'t update information, firstname is required.',
            'email.required'     => 'Couldn\'t update information, email is required.',
            'email.unique'       => 'Couldn\'t update information, this email has already been taken.'
        ] );

        if ( $validator->fails() )
        {
            return redirect()->back()
                ->withErrors( $validator )
                ->withInput();
        }

        $validated_data = $request->all();
        $data           = [
            'firstname'      => $validated_data['firstname'],
            'lastname'       => $validated_data['lastname'],
            'email'          => $validated_data['email'],
            'company'        => isset( $request->company ) ? $request->company : '',
            'street_address' => isset( $request->street_address ) ? $request->street_address : '',
            'postal_code'    => isset( $request->postal_code ) ? $request->postal_code : '',
            'phone'          => isset( $request->phone ) ? $request->phone : '',
            'data'           => serialize( json_encode( $request->all() ) ),
            'updated_at'     => date( 'Y-m-d H:i:s' )
        ];

        $this->user_model->update_user( $data, Auth::user()->id );

        return redirect()->route( 'dashboard.myaccount' )->with( 'message', ['type' => 'success', 'body' => 'Record updated...'] );
    }

    public function update_customer_address( Request $request )
    {
        $data = [];

        foreach ( $request->all() as $key => $value )
        {

            if ( $key === '_token' )
            {
                continue;
            }

            $data[$key] = $value;
        }

        $data['CustomerID'] = ( new Cart() )->get_active_cart_customer();
        $this->ApiObj->Get_CustomerAddressCreateOrUpdate( $data );

        return redirect()->route( 'dashboard.accountinfo' )->with( 'message', ['type' => 'success', 'body' => 'Record updated...'] );
    }

    public function update_password()
    {
        return view( 'dashboard.account-info' );
    }

}
