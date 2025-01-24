<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\OrderPayments;
use App\Http\Controllers\ApisController;
use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\Admin\AdminController;
use App\Jobs\SendMail;

class OrdersController extends AdminController
{
    public $pages, $customRoutes;

    private $order_payment_model;

    public function __construct()
    {
        $this->order_payment_model = new OrderPayments();
        $this->ApiObj              = new ApisController();
        parent::__construct();
    }

    public function index()
    {
        $range = range( 900, 1000 );

        // TODO - Need to fix this ASAP
        if ( env( 'APP_URL', '' ) === 'http://staging.lrhome.us/' || env( 'APP_URL', '' ) === 'https://www.lrhome.us/' )
        {
            $orders = $this->order_payment_model::query()
                ->where( 'order_status', '=', 'failed' )
                ->where( function ( $query ) use ( $range )
            {

                    foreach ( $range as $value )
                {
                        $query->orWhere( 'order_response', 'LIKE', "%{$value}%" );
                    }

                } )
                ->orderBy( 'created_at', 'DESC' )
                ->paginate( 50 );
        }
        else
        {
            $orders = $this->order_payment_model::query()->where( function ( $query ) use ( $range )
            {

                foreach ( $range as $value )
                {
                    $query->orWhereJsonContains( 'order_response', ['ObjectID' => "{$value}"] );
                }

            } )
                ->orderBy( 'created_at', 'DESC' )
                ->paginate( 50 );
        }

        return view( 'admin.orders', ['orders' => $orders, 'active_theme' => $this->active_theme_json] );
    }

    public function process_order( Request $request )
    {

        $validated_data = $request->validate( [
            'order'  => 'required',
            'order-data'  => 'required',
            'submit' => 'required'
        ] );

        $order = $this->order_payment_model->where( 'hash', $validated_data['order'] )->get()->first();

        if ( $order )
        {
            $response = [
                'success' => 0,
                'msg'     => 'Sorry something went wrong...'
            ];
            $validated_data['order-data'] = json_decode($validated_data['order-data'], true);
            $order_data = unserialize( $order->order_data );
            $order_data[0]  = $validated_data['order-data']['General'];;
            $order_data[1]  = $validated_data['order-data']['Items'];
            $headers    = $order_data[0];
            $itemDetail = $order_data[1];

            $total_amount = 0;

            if ( isset( $headers['ShippingCost'] ) )
            {
                $total_amount += $headers['ShippingCost'];
            }

            foreach ( $itemDetail as $item )
            {
                $total_amount += $item['UnitPrice'];
            }

            $result = $this->ApiObj->Place_Order(
                $headers,
                $itemDetail
            );

            $order_payment = $this->order_payment_model->updateOrCreate(
                ['hash' => $order->hash],
                [
                    'order_response' => json_encode( $result ),
                    'order_data'     => serialize( $order_data ),
                    'order_status'   => ConstantsController::ORDER_STATUS['processed']
                ]
            );

            if ( $result['Success'] )
            {
                $order_payment = $this->order_payment_model->updateOrCreate(
                    ['hash' => $order->hash],
                    [
                        'hash' => md5( json_encode( ['general' => $headers, 'items' => $itemDetail, 'status' => ConstantsController::ORDER_STATUS['done']] ) ), // update this hash to avoid any repeating order to be caught by this
                        'order_status' => ConstantsController::ORDER_STATUS['done']
                    ]
                );

                try {
                    $test_email = ConstantsController::ORDER_NOTIFICATION;
                    $webhook_release_data = [
                        'order_no' => $result['ObjectID'],
                    ];
                    SendMail::dispatch( [
                        'data'     => $webhook_release_data,
                        'slug'     => "Web Hook Order Released",
                        'email'    => $test_email,
                        'template' => 'email.web_hook_release_email',
                        'cc_email' => $test_email,
                    ] );
                    prr( " :: Web Hook Release Email Sent :: " );
                }
                catch ( \Exception $e )
                {
                    prr( "Web HookRelease  Email Exception :: ".$e->getMessage() );
                }

                $successMsg = $result['Message'];
                preg_match( "/\[[^\]]*\]/", $successMsg, $matches );
                $matched_string      = $matches[0];
                $updatedString       = '<span>'.$matched_string.'</span>';
                $successMsg          = str_replace( $matched_string, $updatedString, $successMsg );
                $response['success'] = 1;
                $response['msg']     = $successMsg;
            }
            else
            {
                $order_payment = $this->order_payment_model->updateOrCreate(
                    ['hash' => $order->hash],
                    [
                        'order_status' => ConstantsController::ORDER_STATUS['failed']
                    ]
                );

                $errorMsg = $result['Message'];

                if ( $result['ErrorDetail'] )
                {

                    if ( is_array( $result['ErrorDetail'] ) )
                    {
                        $errorDetails = '';

                        foreach ( $result['ErrorDetail'] as $errorDetail )
                        {
                            $errorDetails .= $errorDetail['ErrorDescription'].'<br>';
                        }

                        if ( $errorDetails )
                        {
                            $errorMsg = '<b style="color: red">'.$errorMsg.'</b> <br/><br/>Following are the details: <br/>'.$errorDetails;
                        }

                    }
                    else
                    {
                        $errorMsg = $errorMsg.' ['.$result['ErrorDetail']['ErrorDescription'].']';
                    }

                }

                $response['success'] = 0;
                $response['msg']     = $errorMsg;

            }

            return redirect()->route( 'admin.orders' )->with( 'message', ['type' => $response['success'] ? 'success' : 'danger', 'body' => $response['msg']] );
        }

        return redirect()->route( 'admin.orders' )->with( 'message', ['type' => 'danger', 'body' => 'Something went wrong, please try again...'] );
    }

}
