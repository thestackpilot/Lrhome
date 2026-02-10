<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\Frontend\DesignController;
use App\Http\Controllers\Frontend\CollectionsController;

class ItemController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function generate_color_name( $items )
    {
        $ret_item = array();
        $counter  = 0;

        foreach ( $items['Items'] as $item )
        {
            $item_color        = 'N/A';
            $item_color_image  = '';
            $item_color_design = '';

            foreach ( $items['Colors'] as $color )
            {

                if ( $color['ColorID'] == $item['ColorID'] && $color['DesignID'] == $item['DesignID'] )
                {
                    $item_color        = $color['Description'];
                    $item_color_image  = CommonController::getApiFullImage( $color['ImageName'] );
                    $item_color_design = $color['DesignID'];
                    break;
                }

            }

            $ret_item[$counter]                     = $item;
            $ret_item[$counter]['ItemColor']        = $item_color;
            $ret_item[$counter]['ItemColorDesign']  = $item_color_design;
            $ret_item[$counter++]['ItemColorImage'] = $item_color_image;
        }

        $items['Items'] = $ret_item;

        return $items;
    }

    public function generate_image_urls( $items )
    {
        $ret_item = array();
        $counter  = 0;

        foreach ( $items['Items'] as $item )
        {
            $image_url = array();

            foreach ( $items['ItemImages'] as $imgarr )
            {

                if ( $imgarr['ItemID'] == $item['ItemID'] )
                {

                    if ( ! in_array( CommonController::getApiFullImage( $imgarr['ImageName'] ), $image_url ) )
                    {
                        $image_url[] = CommonController::getApiFullImage( $imgarr['ImageName'] );
                    }

                    foreach ( $imgarr['ChildImages'] as $images )
                    {

                        if ( ! in_array( CommonController::getApiFullImage( $images['ImageName'] ), $image_url ) )
                        {
                            $image_url[] = CommonController::getApiFullImage( $images['ImageName'] );
                        }

                    }

                    break;
                }

            }

            if ( ! $image_url )
            {

                foreach ( $items['Items'] as $k => $inner_item )
                {

                    if ( isset( $inner_item['ImageName'] ) && $inner_item['ImageName'] )
                    {

                        if ( ! in_array( CommonController::getApiFullImage( $inner_item['ImageName'] ), $image_url ) )
                        {
                            $image_url[] = CommonController::getApiFullImage( $inner_item['ImageName'] );
                        }

                        $items['Items'][$k]['ImageName'] = CommonController::getApiFullImage( $inner_item['ImageName'] );
                    }

                }

            }

            if ( isset( $item['ImageName'] ) )
            {
                $item['ImageName'] = CommonController::getApiFullImage( $item['ImageName'] );
            }

            $ret_item[$counter]                     = $item;
            $ret_item[$counter++]['ImageNameArray'] = $image_url;
        }

        $items['Items'] = $ret_item;

        return $items;
    }

    public function generate_price_delivery_info( $items )
    {
        // TODO - Remove this function for future useage
        return $items;

        $ret_item = array();
        $counter  = 0;

        foreach ( $items['Items'] as $item )
        {
            $ret_item[$counter] = $item;
            $customer_counter   = 0;

            if (  ( new Cart() )->get_active_cart_customer() )
            {
                $ret_item[$counter]['UserCustomerInfo']['Customers'][$customer_counter++]['ATSInfo'] = $this->update_ats_prices( $this->ApiObj->Get_ATS( $item['ItemID'], ( new Cart() )->get_active_cart_customer() )['ATSInfo'], $item['ItemID'] );
            }
            else
            {

                foreach ( $item['UserCustomerInfo']['Customers'] as $customers )
                {
                    $ret_item[$counter]['UserCustomerInfo']['Customers'][$customer_counter++]['ATSInfo'] = $this->update_ats_prices( $this->ApiObj->Get_ATS( $item['ItemID'], $customers['CustomerID'] )['ATSInfo'], $item['ItemID'] );
                }

            }

            $counter++;
        }

        $items['Items'] = $ret_item;
    }

    public function generate_size_name( $items )
    {
        $ret_item = array();
        $counter  = 0;

        foreach ( $items['Items'] as $item )
        {
            $item_size          = 'N/A';
            $item_size_design   = '';
            $shipping_dimension = '';

            foreach ( $items['Sizes'] as $size )
            {

                if ( $size['SizeID'] == $item['SizeID'] )
                {
                    $item_size        = $size['Description'];
                    $item_size_design = $size['DesignID'];

                    if ( isset( $size['DimentionalWeight'] ) )
                    {
                        $shipping_dimension = [
                            'DimentionalWeight' => $size['DimentionalWeight'],
                            'ShippingDimension' => $size['ShippingDimension']
                        ];
                    }

                    break;
                }

            }

            $ret_item[$counter]                        = $item;
            $ret_item[$counter]['ItemSize']            = $item_size;
            $ret_item[$counter]['ItemSizeDesign']      = $item_size_design;
            $ret_item[$counter++]['ItemSizeDimension'] = $shipping_dimension;
        }

        $items['Items'] = $ret_item;

        return $items;
    }

    public function generate_user_customer_info( $items )
    {
        $customer = array();

        if ( Auth::user() )
        {

            if ( Auth::user()->is_sale_rep )
            {
                //check if some item in the cart exists for this user - if yes then change the data accordingly
                $customer                 = json_decode( Auth::user()->sales_rep_customers, true );
                $customer['IsSaleRep']    = 1;
                $customer['UserLoggedIn'] = 1;
                $customer['CustomerSet']  = ( new Cart() )->get_active_cart_customer();
            }
            else
            {
                $customer['Customers'][]  = array( 'CustomerID' => Auth::user()->customer_id, 'CompanyName' => Auth::user()->company );
                $customer['IsSaleRep']    = 0;
                $customer['UserLoggedIn'] = 1;
            }

        }
        else
        {
            $customer['Customers'][]  = array( 'CustomerID' => '0', 'CompanyName' => 'N/A' );
            $customer['UserLoggedIn'] = 0;
            $customer['IsSaleRep']    = 0;
        }

        $ret_item = array();
        $counter  = 0;

        foreach ( $items['Items'] as $item )
        {
            $ret_item[$counter]                       = $item;
            $ret_item[$counter++]['UserCustomerInfo'] = $customer;
        }

        $items['Items'] = $ret_item;

        return $items;
    }

    public function get_item_ats( Request $request )
    {

        $return = ['success' => 0, 'data' => json_encode( ['ATSQty' => 0, 'Price' => 0, 'ETADate' => null, 'ETAQty' => 0, 'Message' => 'Not Available'] )];

        if ( $request->has( 'item_id' ) && $request->has( 'customer_id' ) )
        {
            $return = [
                'success' => 1,
                'data'    => $this->update_ats_prices( $this->ApiObj->Get_ATS( $request->item_id, $request->customer_id )['ATSInfo'], $request->item_id )
            ];
        }

        return response()->json( $return );
    }

// Testing ideal link RZY = http://vcs.local.com/item/3/BQ4189
    // Testing ideal link LR = http://vcs.local.com/item/Rugs%20&%20Carpets/81451
    public function index( $id, $design_id, $color_id = 0, $filter="" )
    {
        try {
            
            $items = $this->update_item_prices( $this->generate_size_name( $this->generate_color_name( $this->generate_price_delivery_info( $this->generate_user_customer_info( $this->generate_image_urls( $this->ApiObj->Get_Items( $id, $design_id ) ) ) ) ) ) );

// TODO - Need to REMOVE this chaipi at the top most PRIORITY
            if ( isset( $_GET['refresh'] ) && $_GET['refresh'] )
            {
                $related_designs  = [];
                $main_collections = [];
            }
            else
            {
                $related_designs  = ( new DesignController() )->addDesignUrls( $this->ApiObj->Get_Designs( $id, base64_decode(  ( new CollectionsController() )->generate_single_filter( "Collection", $items['Items'][0]['QualityDescription'] ) ) ), $id ); //
                $main_collections = ( new MainCollectionController() )->get_main_collections();
                $main_collection  = ( new MainCollectionController() )->get_main_collection( $id );

                $this->append_breadcrumbs( $main_collection['Description'], route( 'frontend.favourite', $id ) );
                // $this->append_breadcrumbs( $items['Items'][0]['QualityDescription'], route( 'frontend.designs', [$id, ( new CollectionsController() )->generate_single_filter( "Dining_Tables", ($items['Items'][0]['QualityDescription']==='Dining Table 1')? 'Dining_Tables':$items['Items'][0]['QualityDescription'] ), '0'] ) );
                //$this->append_breadcrumbs( $items['Items'][0]['QualityDescription'], route( 'frontend.designs',  [$id,$filter] ));
                $this->append_breadcrumbs( $items['Items'][0]['QualityDescription'], route( 'frontend.designs', [$id, $filter, '0'] )  );
            }

            return view( 'frontend.'.$this->active_theme->theme_abrv.'.item', [
                'items'            => $items,
                'items_json'       => json_encode( $items ),
                'main_collections' => $main_collections,
                'related_designs'  => $related_designs,
                'color'            => $color_id,
                'design_id'        => $design_id
            ] );
        }
        catch ( \Exception$e )
        {
            return ( new ErrorController() )->index( 404 );
        }

    }

    public function update_ats_prices( $data, $item_id )
    {
        $multiplier = 1;
        $data['OrignalPrice']   = $data['Price'];
        
        if (
            Auth::user() &&
            strcmp( Auth::user()->getDataAttribute( 'cost-type', 'my-cost' ), 'msrp' ) === 0 &&
            Auth::user()->getDataAttribute( 'msrp-multiplier', 1 )
        )
        {
            $multiplier    = Auth::user()->getDataAttribute( 'msrp-multiplier', 1 );
            $data['Price'] = number_format( $data['Price'] * $multiplier, ConstantsController::ALLOWED_DECIMALS, '.', ',' );
        }

        $data['OnlyMaxQuantity'] = (
            CommonController::check_bit_field( $data, 'Discontinued' ) ||
            CommonController::check_bit_field( $data, 'SpecialBuy' ) ||
            CommonController::check_bit_field( $data, 'Reviewed' )
        );

        $data['ATSQtyOrig'] = $data['ATSQty'];
        // $data['ATSQty']     = $data['ATSQty'] - ( new Cart() )->get_item_quantity( $item_id );
        $data['ATSQty']     = $data['ATSQty'] - ( new Cart() )->get_item_quantity( $item_id );
        $data['ETADate']    = date( 'Y-m-d', strtotime( $data['ETADate'] ) );

        if ( Auth::user() && strcmp( Auth::user()->getDataAttribute( 'cost-type' ), 'msrp' ) === 0 )
        {
            $data['CostType'] = 'msrp';
        }
        else
        {
            $data['CostType'] = 'wholesale';
        }

        return $data;

    }

    public function update_item_prices( $items )
    {
        $multiplier = 1;

        if (
            Auth::user() &&
            strcmp( Auth::user()->getDataAttribute( 'cost-type', 'my-cost' ), 'msrp' ) === 0 &&
            Auth::user()->getDataAttribute( 'msrp-multiplier', 1 )
        )
        {
            $multiplier = Auth::user()->getDataAttribute( 'msrp-multiplier', 1 );

            foreach ( $items['Items'] as &$item )
            {
                $item['BasePrice'] = number_format( $item['BasePrice'] * $multiplier, ConstantsController::ALLOWED_DECIMALS, '.', ',' );
            }

        }

        return $items;

    }

}
