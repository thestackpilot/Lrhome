<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\Frontend\FrontendController;

class CartController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add( Request $request )
    {
        try
        {

            if ( strcmp( ConstantsController::USER_ROLES['admin'], Auth::user()->role ) === 0 )
            {
                return response()->json( array( 'success' => 0, 'message' => "Admin user cannot be used to place orders." ) );
            }

            if (  ( new Cart() )->get_active_cart_customer() && ( new Cart() )->get_active_cart_customer() !== $request->cart_customer_id )
            {
                return response()->json( array( 'success' => 0,  'existing' => ( new Cart() )->get_active_cart_customer(), 'current' => $request->cart_customer_id, 'message' => "You already have a different customer in the cart, please refresh the page and try again." ) );
            }

            ( new Cart() )->save_or_update_full_cart_item( $request );

            return response()->json( array( 'success' => 1, 'message' => "Item is added in the Cart" ), 200 );
        }
        catch ( \Exception$e )
        {
            prr( $e->getMessage() );

            return response()->json( array( 'success' => 0, 'message' => "There is an error in saving your item in the cart. Please try again." ) );
        }

    }

    public function refresh( Request $request, $type )
    {

        if ( Auth::user() )
        {
            return response()->view
            (
                'frontend.'.$this->active_theme->theme_abrv.'.components.'.$type,
                array
                (
                    'cart' => CommonController::convert_array_to_obj_recursive
                    (
                        ( new Cart() )->get_cart_for_front( $this->ApiObj )
                    )
                ), 200
            )
                ->header( 'Content-Type', "application/html" );
        }

        return response( '', 200 )->header( 'Content-Type', 'text/html' );
    }

    public function remove( Request $request )
    {
        try
        {
            ( new Cart() )->remove_cart_item( Auth::user()->id, $request->customerId, $request->itemId );

            return response()->json( array( 'success' => 1, 'message' => "The item was removed from cart successfully" ), 200 );
        }
        catch ( \Exception$e )
        {
            prr( $e->getMessage() );

            return response()->json( array( 'success' => 0, 'message' => "There is an error in removing item from your cart. Please try again." ), 400 );
        }

    }

    public function update( Request $request )
    {
        try
        {
            ( new Cart() )->update_cart_item( Auth::user()->id, $request->customerId, $request->itemId, $request->newQuantity );

            $cart_count = 0;
            $cart_total = 0;
            $cart_currency = '';
            $cart_items_total = array();
            $cart_items = ( new Cart() )->get_cart_for_front( $this->ApiObj );

            foreach ( $cart_items['items'] as $cart_item )
            {
                $cart_count += $cart_item['item_quantity'];
                $cart_total += ( $cart_item['item_price'] * $cart_item['item_quantity'] );
                $cart_currency = $cart_item['item_currency'];
                $cart_items_total[$cart_item['item_id']] = $cart_item['item_price'] * $cart_item['item_quantity'];
            }
            $cart_total = number_format( $cart_total, ConstantsController::ALLOWED_DECIMALS, '.', ',' );

            return response()->json( array( 'success' => 1, 'cart_count' => $cart_count, 'cart_currency' => $cart_currency, 'cart_items_total' => $cart_items_total, 'cart_total' => $cart_total, 'message' => "Cart is updated successfully" ), 200 );
        }
        catch ( \Exception$e )
        {
            prr( $e->getMessage() );

            return response()->json( array( 'success' => 0, 'message' => "There is an error in updating your cart. Please try again." ), 400 );
        }

    }

}
