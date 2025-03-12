<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\ConstantsController;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'customer_id', 'item_id', 'item_name', 'item_quantity', 'item_price', 'item_color', 'item_size', 'item_currency', 'item_image', 'item_eta'];

    //check if the user has an active cart item
    public function get_active_cart_customer()
    {
        $customer_id = 0;

        if ( Auth::user() && $this->where( 'user_id', Auth::user()->id )->count() )
        {
            $customer_id = $this->select( 'customer_id' )->where( 'user_id', Auth::user()->id )->latest( 'id' )->first()->customer_id;
        }

        return $customer_id;
    }

    //data for the front end
    public function get_cart_for_front( $ApiObj )
    {

        if ( ! Auth::user() )
        {
            return array(
                'cart_count'    => 0,
                'cart_total'    => 0,
                'cart_currency' => '$',
                'items'         => array()
            );
        }

        $user_id = Auth::user()->id;

        $customers = array( Auth::user()->customer_id );

        if ( strlen( Auth::user()->sales_rep_customers ) )
        {

            foreach ( json_decode( Auth::user()->sales_rep_customers )->Customers as $customer )
            {
                $customers[] = $customer->CustomerID;
            }

        }

        $cart       = array( 'items' => array() );
        $cart_count = 0;
        $cart_total = 0;

        $cart_items     = $this->where( 'user_id', $user_id )->whereIn( 'customer_id', $customers )->get();
        $max_quantities = [];

        if ( $cart_items )
        {
            $items = [];

            foreach ( $cart_items as $cart_item )
            {
                $items[$cart_item->item_id] = $cart_item->item_id;
            }

            if ( $items )
            {
                $item_prices = $ApiObj->Get_GetMultipleItemsPrices( $this->get_active_cart_customer(), join( ',', $items ) );

                if ( $item_prices['Success'] )
                {

                    foreach ( $item_prices['ItemPrices'] as $item_price )
                    {
                        $item_quantity                         = $this->get_item_quantity( $item_price['ItemID'] );
                        $item_atsq                             = isset( $item_price['ATSQ'] ) && $item_price['ATSQ'] ? $item_price['ATSQ'] : 0;
                        $item_atsq                             = $item_atsq ? ( $item_price['ATSQ'] - ( $item_quantity ? $item_quantity : 0 ) ) : $item_quantity;
                        $max_quantities[$item_price['ItemID']] = [
                            'ATSQ'            => $item_atsq > -1 ? $item_atsq : $item_quantity,
                            'OnlyMaxQuantity' => CommonController::check_bit_field( $item_price, 'Discontinued' ) ||
                            CommonController::check_bit_field( $item_price, 'SpecialBuy' ) ||
                            CommonController::check_bit_field( $item_price, 'Reviewed' )
                        ];

                    }

                }
            }

        }

        foreach ( $cart_items as $cart_item )
        {
            $cart['items'][] = array(
                "item_id"                => $cart_item->item_id,
                "item_customer_id"       => $cart_item->customer_id,
                "item_name"              => $cart_item->item_name,
                "item_quantity"          => $cart_item->item_quantity,
                "item_price"             => number_format( $cart_item->item_price, ConstantsController::ALLOWED_DECIMALS, '.', '' ),
                "item_total"             => number_format( $cart_item->item_price * $cart_item->item_quantity, ConstantsController::ALLOWED_DECIMALS, '.', '' ),
                "item_color"             => $cart_item->item_color,
                "item_size"              => $cart_item->item_size,
                "item_currency"          => $cart_item->item_currency,
                "item_image"             => $cart_item->item_image,
                "item_eta"               => $cart_item->item_eta,
                "item_atsq"              => isset( $max_quantities[$cart_item->item_id] ) ? $max_quantities[$cart_item->item_id]['ATSQ'] : 9999,
                "item_only_max_quantity" => isset( $max_quantities[$cart_item->item_id] ) ? $max_quantities[$cart_item->item_id]['OnlyMaxQuantity'] : false,
                "sidemark"             => $cart_item->sidemark,
            );
            $cart_count += $cart_item->item_quantity;
            $cart_total += ( $cart_item->item_price * $cart_item->item_quantity );
            $cart['cart_currency'] = $cart_item->item_currency;
        }

        $cart['cart_count']    = $cart_count;
        $cart['cart_total']    = number_format( $cart_total, ConstantsController::ALLOWED_DECIMALS, '.', ',' );
        $cart['cart_currency'] = '$';

        return $cart;
    }

    public function get_cart_with_meta_raw()
    {
        return (object) array(
            "cart_count" => 3,
            "cart_total" => 381,
            "items"      => (object) array(
                "ADAAN692A57335373" => (object) array(
                    "item_id"          => "ADAAN692A57335373",
                    "item_customer_id" => "SPARCSD",
                    "item_name"        => "Fancy Pillow",
                    "item_quantity"    => 3,
                    "item_price"       => 120,
                    "item_color"       => "Black",
                    "item_size"        => "14 x 2",
                    "item_currency"    => '$',
                    "item_image"       => 'https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-2.jpg',
                    "item_eta"         => "1900-01-01T00:00:00"
                )
            )
        );
    }

    public function get_item_quantity( $item_id )
    {
        return $this->select( DB::raw( 'SUM(item_quantity) as total_quantity' ) )->where( 'item_id', $item_id )->first()->total_quantity;
    }

    // soft Delete menu that no longer in theme
    public function remove_cart_item( $user_id, $customer_id, $item_id, $delete_all = false )
    {

        if ( $delete_all )
        {
            $this->where( 'user_id', $user_id )->where( 'customer_id', $customer_id )->delete();
        }
        else
        {
            $this->where( 'user_id', $user_id )->where( 'customer_id', $customer_id )->where( 'item_id', $item_id )->delete();
        }

    }

    // save or update menus and meta
    public function save_or_update_full_cart_item( $request )
    {
        $item     = $this->where( 'user_id', Auth::user()->id )->where( 'customer_id', $request->cart_customer_id )->where( 'item_id', $request->cart_item_id )->first();
        $quantity = $request->cart_item_quantity;

        if ( $item )
        {
            $quantity += $item->item_quantity;
        }

        $this->updateOrCreate(
            ['user_id' => Auth::user()->id, 'customer_id' => $request->cart_customer_id, 'item_id' => $request->cart_item_id],
            [
                'user_id'    => Auth::user()->id, 'customer_id'           => $request->cart_customer_id, 'item_id'           => $request->cart_item_id,
                'item_name'  => $request->cart_item_name, 'item_quantity' => $quantity, 'item_price'                         => number_format( str_replace(',', '', $request->cart_item_price), ConstantsController::ALLOWED_DECIMALS, '.', '' ),
                'item_color' => $request->cart_item_color, 'item_size'    => $request->cart_item_size, 'item_currency'       => $request->cart_item_currency,
                'item_image' => $request->cart_item_image, 'item_data'    => serialize( $request->cart_item_data ), 'item_eta' => $request->cart_item_eta
            ]
        );
    }

    // update cart value
    public function update_cart_item( $user_id, $customer_id, $item_id, $quantity )
    {
        $this->updateOrCreate(
            ['user_id' => $user_id, 'customer_id' => $customer_id, 'item_id' => $item_id],
            ['user_id' => $user_id, 'customer_id' => $customer_id, 'item_id' => $item_id, 'item_quantity' => $quantity]
        );
    }

}
