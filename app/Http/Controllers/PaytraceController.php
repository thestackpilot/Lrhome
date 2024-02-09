<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;

class PaytraceController extends RootController
{
    public $accessToken;

    public $accessTokenArray;

    public function __construct()
    {
        try
        {
            parent::__construct();
            $token_response = Http::timeout( 10 )->post( ConstantsController::PAYMENT_GATEWAY['paytrace']['auth_url'], [
                'grant_type' => ConstantsController::PAYMENT_GATEWAY['paytrace']['grant_type'],
                'username'   => ConstantsController::PAYMENT_GATEWAY['paytrace']['user'],
                'password'   => ConstantsController::PAYMENT_GATEWAY['paytrace']['pass']
            ] );
            prr( ['Paytrace token_response :: ' => $token_response->json()] );
            $this->accessToken      = $token_response->json()['access_token'];
            $this->accessTokenArray = ['Authorization' => "Bearer {$token_response->json()['access_token']}"];
        }
        catch ( ConnectionException $e )
        {
            prr( "---=======PAYTRACE API IS NOT WORKING=======---" );

            return;
        }
        catch ( Exception $e )
        {
            prr( "=======PAYTRACE API IS NOT WORKING=======" );

            return;
        }

    }

    public function capture_or_void_transaction( $transaction_id, $action )
    {

        try {
            $url = '';

            switch ( $action )
            {
                case 'capture':
                    // $url = ConstantsController::PAYMENT_GATEWAY['paytrace']['capture_transaction_url'];
                    $url = ConstantsController::PAYMENT_GATEWAY['paytrace']['void_transaction_url'];
                    break;
                case 'void':
                    $url = ConstantsController::PAYMENT_GATEWAY['paytrace']['void_transaction_url'];
                    break;
            }

            return $this->send_request( $url, [
                'transaction_id' => $transaction_id,
                'integrator_id'  => ConstantsController::PAYMENT_GATEWAY['paytrace']['integrator_id']
            ] );
        }
        catch ( \Exception$e )
        {
            prr( ['capture_or_void_transaction::Exception' => $e->getMessage()] );

            return [];
        }

    }

    public function create_customer( $customer_id, $card_details )
    {

        try {
            return $this->send_request( ConstantsController::PAYMENT_GATEWAY['paytrace']['create_client_url'], [
                'customer_id'     => $customer_id,
                'integrator_id'   => ConstantsController::PAYMENT_GATEWAY['paytrace']['integrator_id'],
                'credit_card'     => [
                    'encrypted_number' => $card_details['ccNumber'],
                    'expiration_month' => trim( explode( '/', $card_details['ccExpiry'] )[0] ),
                    'expiration_year'  => trim( explode( '/', $card_details['ccExpiry'] )[1] )
                ],
                // 'encrypted_csc'   => $card_details['ccCSC'],
                'billing_address' => [
                    'street_address' => $card_details['billing_address']['address'],
                    'name'           => $card_details['billing_address']['name'],
                    'city'           => $card_details['billing_address']['city'],
                    'state'          => $card_details['billing_address']['state'],
                    'zip'            => $card_details['billing_address']['zip']
                ]
            ] );
        }
        catch ( \Exception$e )
        {
            prr( ['create_customer::Exception' => $e->getMessage()] );

            return [];
        }

    }

    public function create_customer_from_transaction( $payment_response, $customer_id, $card_details )
    {

        try {
            return $this->send_request( ConstantsController::PAYMENT_GATEWAY['paytrace']['create_client_from_transaction_url'], [
                'customer_id'     => $customer_id,
                'transaction_id'  => $payment_response['transaction_id'],
                'integrator_id'   => ConstantsController::PAYMENT_GATEWAY['paytrace']['integrator_id'],
                'billing_address' => [
                    'street_address' => $card_details['billing_address']['address'],
                    'name'           => $card_details['billing_address']['name'],
                    'city'           => $card_details['billing_address']['city'],
                    'state'          => $card_details['billing_address']['state'],
                    'zip'            => $card_details['billing_address']['zip']
                ]
            ] );
        }
        catch ( \Exception$e )
        {
            prr( ['create_customer_from_transaction::Exception' => $e->getMessage()] );

            return [];
        }

    }

    public function get_customer( $customer_id )
    {
        try {
            return $this->send_request( ConstantsController::PAYMENT_GATEWAY['paytrace']['client_url'], [
                'customer_id'   => $customer_id,
                'integrator_id' => ConstantsController::PAYMENT_GATEWAY['paytrace']['integrator_id']
            ] );
        }
        catch ( \Exception$e )
        {
            prr( ['get_customer::Exception' => $e->getMessage()] );

            return [];
        }

    }

    public function process_payment( $card_details, $total_amount, $customer_id = 0, $invoice_id = -1 )
    {
        try {

            if ( isset( $card_details['type'] ) && $card_details['type'] != 'new' )
            {
                return $this->send_request( ConstantsController::PAYMENT_GATEWAY['paytrace']['customer_transaction_url'], [
                    'amount'      => $total_amount,
                    'customer_id' => $customer_id
                ] );
            }
            else
            {
                return $this->send_request( ConstantsController::PAYMENT_GATEWAY['paytrace']['transaction_url'], [
                    'amount'          => $total_amount,
                    'credit_card'     => [
                        'encrypted_number' => $card_details['ccNumber'],
                        'expiration_month' => trim( explode( '/', $card_details['ccExpiry'] )[0] ),
                        'expiration_year'  => trim( explode( '/', $card_details['ccExpiry'] )[1] )
                    ],
                    'integrator_id'   => ConstantsController::PAYMENT_GATEWAY['paytrace']['integrator_id'],
                    'encrypted_csc'   => $card_details['ccCSC'],
                    'invoice_id'      => $invoice_id,
                    'billing_address' => [
                        'street_address' => $card_details['billing_address']['address'],
                        'name'           => $card_details['billing_address']['name'],
                        'city'           => $card_details['billing_address']['city'],
                        'state'          => $card_details['billing_address']['state'],
                        'zip'            => $card_details['billing_address']['zip']
                    ]
                ] );
            }

        }
        catch ( \Exception$e )
        {
            prr( ['process_payment::Exception' => $e->getMessage()] );

            return [];
        }

    }

    public function send_request( $url, $data )
    {
        try {
            $response = Http::timeout( 30 )
                ->withHeaders( $this->accessTokenArray )
                ->post( $url, $data );

            prr( [
                'url'      => $url,
                'request'  => $data,
                'response' => $response->json()
            ] );

            return $response->json();
        }
        catch ( \Exception$e )
        {
            prr( ['send_request::Exception' => $e->getMessage()] );

            return [];
        }
        catch ( \Error$e )
        {
            prr( ['send_request::Error' => $e->getMessage()] );

            return [];
        }

    }

    public function update_customer( $customer_id, $card_details )
    {

        try {
            return $this->send_request( ConstantsController::PAYMENT_GATEWAY['paytrace']['update_client_url'], [
                'customer_id'     => $customer_id,
                'integrator_id'   => ConstantsController::PAYMENT_GATEWAY['paytrace']['integrator_id'],
                'credit_card'     => [
                    'encrypted_number' => $card_details['ccNumber'],
                    'expiration_month' => trim( explode( '/', $card_details['ccExpiry'] )[0] ),
                    'expiration_year'  => trim( explode( '/', $card_details['ccExpiry'] )[1] )
                ],
                // 'encrypted_csc'   => $card_details['ccCSC'],
                'billing_address' => [
                    'street_address' => $card_details['billing_address']['address'],
                    'name'           => $card_details['billing_address']['name'],
                    'city'           => $card_details['billing_address']['city'],
                    'state'          => $card_details['billing_address']['state'],
                    'zip'            => $card_details['billing_address']['zip']
                ]
            ] );
        }
        catch ( \Exception$e )
        {
            prr( ['update_customer::Exception' => $e->getMessage()] );

            return [];
        }

    }

}
