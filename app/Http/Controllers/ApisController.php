<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Client\ConnectionException;
use App\Http\Controllers\Frontend\FilterController;

class ApisController extends RootController
{
    public $accessToken;

    public $accessTokenArray;

    public function ChangePassword( $userId, $old_password, $password )
    {
        $post_array = array( 'UserID' => $userId, 'OldPassword' => $old_password, 'NewPassword' => $password, 'ConfirmPassword' => $password );

        return $this->Post_API_Signature( 'ChangePassword', 'Change Password', $post_array, ['Success', 'Message'], 0 );
    }

    public function Create_DealerAccount( $userId = '', $email, $firstname, $lastname, $password, $companyName, $postCode, $city, $country, $province, $intrestedIn, $number, $fax )
    {
        $post_array = array(
            'UserID'          => $userId,
            'Email'           => $email,
            'FirstName'       => $firstname,
            'LastName'        => $lastname,
            'Password'        => $password,
            'CompanyName'     => $companyName,
            'PostCode'        => $postCode,
            'City'            => $city,
            'Country'         => $country,
            'StateProvince'   => $province,
            'InterestedIn'    => $intrestedIn,
            'TelephoneNumber' => $number,
            'FaxNumber'       => $fax
        );

        return $this->Post_API_Signature( 'Create_DealerAccount', 'Create Dealer Account', $post_array, ['Success', 'Message'], 0 );
    }

    public function Get_ATS( $itemId, $customerId = '' )
    {
        $post_array    = array( 'ItemID' => $itemId, 'CustomerID' => $customerId );
        $responseArray = $this->Post_API_Signature( 'Get_ATS', 'Get ATS', $post_array );

        return array( "ATSInfo" => $responseArray['OutPut'] );
    }

    public function Get_B2BOrderInquiryData( $FilterType, $Category = '', $SubCategory = '', $Collection = '', $Design = '', $Color = '', $Size = '' )
    {
        $post_array = [
            'FilterType'  => $FilterType,
            'Category'    => $Category,
            'SubCategory' => $SubCategory,
            'Collection'  => $Collection,
            'Design'      => $Design,
            'Color'       => $Color,
            'Size'        => $Size
        ];

        return $this->Post_API_Signature( 'Get_B2BOrderInquiryData', 'Get Order Inquiry Data', $post_array, [], 0 );
    }

    public function Get_AllStatus()
    {
        $post_array = [];

        return $this->Post_API_Signature( 'Get_AllStatus', 'Get All Statuses', $post_array, ['Success', 'Message', 'StatusList'], 1, 1, 1 );
    }

    public function Get_Collections( $mainCollectionId = 1, $collectionType = "Collections", $LifeStyleID = '', $CollectionID = '', $DesignID = '', $ColorID = '', $SizeID = '', $ShapeID = '', $MaterialID = '', $WeavingID = '', $filters = '' )
    {
        $post_array = array( 'MainCollectionID' => $mainCollectionId, 'LifeStyleID' => $LifeStyleID, 'CollectionID' => $CollectionID, 'DesignID' => $DesignID, 'ColorID' => $ColorID, 'SizeID' => $SizeID, 'ShapeID' => $ShapeID, 'MaterialID' => $MaterialID, 'WeavingID' => $WeavingID, 'Filters' => $filters );

        return $this->Post_API_Signature( "Get_{$collectionType}", "Get {$collectionType}", $post_array, [$collectionType] );
    }

    public function Get_Collections_With_Filters( $mainCollectionId = 1, $collectionType = "Collections", $Filters = '' )
    {
        list( $Filters, $OrderBy ) = ( new FilterController() )->get_sort_filter( $Filters );
        $post_array              = array( 'MainCollectionID' => $mainCollectionId, 'Filters' => $Filters, 'OrderBy' => $OrderBy );
        prr( $post_array );

        return $this->Post_API_Signature( "Get_{$collectionType}", "Get {$collectionType}", $post_array, [$collectionType] );
    }

    public function Get_CompanyCredit( $customerId )
    {
        $post_array = array( 'CustomerID' => $customerId );

        return $this->Post_API_Signature( 'Get_CustomerCredit', 'Get Customer Credit', $post_array );
    }

    public function Get_CountriesList()
    {
        return $this->Post_API_Signature( 'Get_CountriesList', 'Get Countries List', [], ['Countries', 'Success', 'Message'], 0, 1, 1 );
    }

    public function Get_CountryStates( $country )
    {
        return $this->Post_API_Signature( 'Get_CountryStates', 'Get Countries States', ['Country' => $country], ['States', 'Success', 'Message'], 0 );
    }

    public function Get_CreditMemos( $customerId, $SalesRep = '', $FromDate = '', $ToDate = '', $SalesInvoiceNo = '', $CustomerPO = '', $PageIndex = 1, $PageSize = 25 )
    {
        $post_array = array( 'CustomerID' => $customerId, 'SalesRepID' => $SalesRep, 'FromDate' => $FromDate, 'ToDate' => $ToDate, 'SalesInvoiceNo' => $SalesInvoiceNo, 'CustomerPO' => $CustomerPO, 'PageIndex' => $PageIndex, 'PageSize' => $PageSize );

        return $this->Post_API_Signature( 'Get_CreditMemos', 'Get CreditMemos', $post_array, ['CreditMemos', 'TotalRows'] );
    }

    public function Get_CustomerAddressCreateOrUpdate( $data )
    {
        $post_array = $data;

        return $this->Post_API_Signature( 'Get_CustomerAddressCreateOrUpdate', 'Update Customer Address', $post_array );
    }

    public function Get_CustomerAddresses( $customerId )
    {
        $post_array = [
            'CustomerID' => $customerId
        ];

        return $this->Post_API_Signature( 'Get_CustomerAddresses', 'Get Shipping Addresses', $post_array, ['Success', 'Message', 'CustomerAddress'] );
    }

    public function Get_CustomerDetail( $customerId )
    {
        $post_array = [
            'CustomerID' => $customerId
        ];

        return $this->Post_API_Signature( 'Get_CustomerDetail', 'Get Customer Details', $post_array, ['Success', 'Message', 'CustomerDetail'] );
    }

    public function Get_DebitMemos( $customerId, $FromDate = '', $ToDate = '', $PayableInvoiceNo = '', $VendorID = '' )
    {
        $post_array = array( 'CustomerID' => $customerId, 'FromDate' => $FromDate, 'ToDate' => $ToDate, 'PayableInvoiceNo' => $PayableInvoiceNo, 'VendorID' => $VendorID );

        return $this->Post_API_Signature( 'Get_DebitMemos', 'Get Debit Memos', $post_array, ['DebitMemos'] );
    }

    public function Get_Designs( $mainCollectionId = 1, $Filters = '', $SearchText = '', $LifeStyleID = '', $CollectionID = '', $DesignID = '', $ColorID = '', $SizeID = '', $ShapeID = '', $MaterialID = '', $WeavingID = '', $PageSize = 30, $PageIndex = "1" )
    {
        list( $Filters, $OrderBy ) = ( new FilterController() )->get_sort_filter( $Filters );
        $post_array              = array( 'MainCollectionID' => $mainCollectionId, 'Filters' => $Filters, 'SearchText' => $SearchText, 'LifeStyleID' => $LifeStyleID, 'CollectionID' => $CollectionID, 'DesignID' => $DesignID, 'ColorID' => $ColorID, 'SizeID' => $SizeID, 'ShapeID' => $ShapeID, 'MaterialID' => $MaterialID, 'WeavingID' => $WeavingID, 'PageSize' => $PageSize, 'PageIndex' => $PageIndex, 'OrderBy' => $OrderBy );

        return $this->Post_API_Signature( 'Get_Designs', 'Get Design', $post_array, ['Designs', 'TotalRows'] );
    }

    public function Get_Docuemnts()
    {
        $get_type = 1;

        return $this->Post_API_Signature( 'Get_Documents', 'Get Documents', $post_array = array(), ['Documents'], 1, 1, 1 );
    }

    public function Get_ETA( $itemId, $customerId = '' )
    {
        $post_array = array( 'ItemID' => $itemId, 'CustomerID' => $customerId );

        return $this->Post_API_Signature( 'Get_ETA', 'Get ETA', $post_array, ['ETAInfo'] );
    }

    public function Get_Favourities( $mainCollectionId )
    {
        $post_array = array( 'MainCollectionID' => $mainCollectionId );

        return $this->Post_API_Signature( 'Get_Favourities', 'Get Favourities', $post_array, ['Favourities'] );
    }

    public function Get_FilterPages( $mainCollectionId = 1, $filterType = "SpecialBuys", $CategoryID = '', $SubCategoryID = '', $CollectionID = '', $DesignID = '', $ColorID = '', $SizeID = '', $ShapeID = '', $MaterialID = '', $WeavingID = '', $Filters = '', $SearchText = '' )
    {
        //if ($mainCollectionId == 0) $mainCollectionId = '';
        $post_array = array( 'MainCollectionID' => $mainCollectionId, 'CategoryID' => $CategoryID, 'SubCategoryID' => $SubCategoryID, 'CollectionID' => $CollectionID, 'DesignID' => $DesignID, 'ColorID' => $ColorID, 'SizeID' => $SizeID, 'ShapeID' => $ShapeID, 'MaterialID' => $MaterialID, 'WeavingID' => $WeavingID, 'Filters' => $Filters, 'SearchText' => $SearchText );

        return $this->Post_API_Signature( "Get_{$filterType}List", "Get {$filterType} List", $post_array );
    }

    public function Get_Filters( $mainCollectionId, $subCategory = '', $selectedFilters = [] )
    {
        $post_array = array( 'MainCollectionID' => $mainCollectionId );

        if ( $subCategory )
        {
            $post_array['SubCategoryID'] = $subCategory;
        }

        $post_array = $post_array + $selectedFilters;

        return $this->Post_API_Signature( 'Get_Filters', 'Get Filters', $post_array, ['Filters'] );
    }

    public function Get_FinancialTransactions( $customerId, $SalesRep = '', $FromDate = '', $ToDate = '', $CustomerPO = '', $SalesInvoiceNo = '', $CashReceiptNo = '', $PageIndex = 1, $PageSize = 25 )
    {
        $post_array = array( 'CustomerID' => $customerId, 'SalesRepID' => $SalesRep, 'FromDate' => $FromDate, 'ToDate' => $ToDate, 'CustomerPO' => $CustomerPO, 'SalesInvoiceNo' => $SalesInvoiceNo, 'CashReceiptNo' => $CashReceiptNo, 'PageIndex' => $PageIndex, 'PageSize' => $PageSize );

        return $this->Post_API_Signature( 'Get_FinancialTransactions', 'Get Financial Transaction', $post_array, ['FinancialTransactions', 'TotalRows'] );
    }

    public function Get_GetHangTagsDetailData( $ItemID = '', $CustomerID = '', $HangTagWithMap = '' )
    {
        $post_array = array( 'ItemID' => $ItemID, 'CustomerID' => $CustomerID, 'HangTagWithMap' => $HangTagWithMap );

        return $this->Post_API_Signature( 'Get_GetHangTagsDetailData', 'Get Hang Tags Item Details Data', $post_array, ['HangTagsDetail', 'Message'] );
    }

    public function Get_GetHangTagsSearchData( $CollectionID = '', $DesignID = '', $ColorID = '' )
    {
        $post_array = array( 'Collection' => $CollectionID, 'DesignID' => $DesignID, 'ColorID' => $ColorID );

        return $this->Post_API_Signature( 'Get_GetHangTagsSearchData', 'Get Hang Tags Search Data', $post_array, ['HangTags', 'Message'], 0 );
    }

    public function Get_GetMultipleItemsPrices( $CustomerID, $ItemID )
    {
        $post_array = ['CustomerID' => $CustomerID, 'ItemID' => $ItemID];

        return $this->Post_API_Signature( 'Get_GetMultipleItemsPrices', 'GetMultipleItemsPrices', $post_array, ['Success', 'Message', 'ErrorDetail', 'ItemPrices'], 0 );
    }

    public function Get_Invoices( $customerId = '', $SalesRep = '', $SalesInvoiceNo = '', $CustomerPO = '', $FromDate = '', $ToDate = '', $PageIndex = 1, $PageSize = 25 )
    {
        $post_array = array( 'CustomerID' => $customerId, 'SalesRepID' => $SalesRep, 'SalesInvoiceNo' => $SalesInvoiceNo, 'CustomerPO' => $CustomerPO, 'FromDate' => $FromDate, 'ToDate' => $ToDate, 'PageIndex' => $PageIndex, 'PageSize' => $PageSize );

        return $this->Post_API_Signature( 'Get_Invoices', 'Get Invoices', $post_array, ['SalesInvoices', 'TotalRows'] );
    }

    public function Get_Items( $MainCollectionId = 1, $DesignID = '', $ItemID = '', $ExternalID = '', $SubCategory = '', $CollectionID = '', $ColorID = "", $SizeID = '', $UpdatedDateFrom = '', $UpdatedDateTo = '', $ProductType = '', $IsDeleted = '', $HasExternalID = '' )
    {
        $post_array = array( 'MainCollectionID' => $MainCollectionId, 'DesignID' => $DesignID, 'ItemID' => $ItemID, 'ExternalID' => $ExternalID, 'SubCategory' => $SubCategory, 'CollectionID' => $CollectionID, 'ColorID' => $ColorID, 'SizeID' => $SizeID, 'UpdatedDateFrom' => $UpdatedDateFrom, 'UpdatedDateTo' => $UpdatedDateTo, 'ProductType' => $ProductType, 'IsDeleted' => $IsDeleted, 'HasExternalID' => $HasExternalID );

        return $this->Post_API_Signature( 'Get_Items', 'Get Items', $post_array, ['Items', 'Colors', 'Sizes', 'ItemImages', 'PillowCovers', 'ItemsETA'] );
    }

    public function Get_ItemsDetail( $CustomerID, $ProductType = '', $Collection = '', $Design = '', $Color = '', $Size = '' )
    {
        $post_array = [
            'CustomerID'  => $CustomerID,
            'ProductType' => $ProductType,
            'Collection'  => $Collection,
            'Design'      => $Design,
            'Color'       => $Color,
            'Size'        => $Size
        ];

        return $this->Post_API_Signature( 'Get_ItemsDetail', 'Get Items Detail', $post_array, [], 0 );
    }

    public function Get_ItemsPlaceOrderDetail( $CustomerID, $Category = '', $SubCategory = '', $Collection = '', $Design = '', $Color = '', $Size = '', $ItemID = '' )
    {
        $post_array = [
            'CustomerID'  => $CustomerID,
            'Category'    => $Category,
            'SubCategory' => $SubCategory,
            'Collection'  => $Collection,
            'Design'      => $Design,
            'Color'       => $Color,
            'Size'        => $Size,
            'ItemID'      => $ItemID
        ];

        return $this->Post_API_Signature( 'Get_ItemsPlaceOrderDetail', 'Get Items Detail', $post_array, [], 0 );
    }

    public function Get_Main_Collections()
    {
        $post_array = array( 'MainCollectionID' => null );

        return $this->Post_API_Signature( 'Get_MainCollections', 'Main Collections', $post_array, ['MainCollections'] );
    }

    public function Get_OrderInquiryData( $FilterType, $ProductType = '', $Collection = '', $Design = '', $Color = '', $Size = '' )
    {
        $post_array = [
            'FilterType'  => $FilterType,
            'ProductType' => $ProductType,
            'Collection'  => $Collection,
            'Design'      => $Design,
            'Color'       => $Color,
            'Size'        => $Size
        ];

        return $this->Post_API_Signature( 'Get_OrderInquiryData', 'Get Order Inquiry Data', $post_array, [], 0 );
    }

    public function Get_PaymentTermsList()
    {
        return $this->Post_API_Signature( 'Get_PaymentTermsList', 'Get Payment Terms', [], ['PaymentTerms', 'Success', 'Message'], 1, 1, 1 );
    }

    public function Get_RMA_Generated( $CustomerID = '', $RequestBy = '', $detail = [] )
    {
        $post_array = array( 'CustomerID' => $CustomerID, 'RequestBy' => $RequestBy, 'Details' => $detail );
        prr( $post_array );

        return $this->Post_API_Signature( 'RMA_GenerateReturn', 'Get RMA', $post_array, ['RMANo', 'Success', 'Message'], 0 );
    }

    public function Get_ReturnReasonList()
    {
        $post_array = array();

        return $this->Post_API_Signature( 'Get_ReturnReasonList', 'Get Return Reasons', $post_array, ['ReturnReasons', 'Success', 'Message'], 1, 1, 1 );
    }

    public function Get_Search_Text( $string = '', $collection_id = '' )
    {
        $post_array = array( 'SearchText' => $string, 'CollectionID' => $collection_id );

        return $this->Post_API_Signature( 'Get_SearchText', 'Get Search Text', $post_array );
    }

    public function Get_ShipViaList()
    {
        $post_array = array();

        return $this->Post_API_Signature( 'Get_ShipViaList', 'Get Ship Via List', $post_array, ['Success', 'Message', 'ShipVias'], 1, 1, 1 );
    }

    public function Get_ShippingRates( $CustomerID = '', $ShipViaID = '', $detail = [] )
    {
        $post_array = array( 'CustomerID' => $CustomerID, 'ShipViaID' => $ShipViaID, 'Detail' => $detail );

        return $this->Post_API_Signature( 'Get_ShippingRates', 'Get Shipping Rates', $post_array, ['Success', 'Message', 'ShippingRates'], 0 );
    }

    public function Get_Shipping_Options( $customerId )
    {
        $post_array = [
            'CustomerID' => $customerId
        ];

        return $this->Post_API_Signature( 'Get_ShippingOptions', 'Get Shipping Options', $post_array, ['Success', 'Message', 'CustomerShipVias'] );
    }

    public function Get_Shipping_Rates( $customerId, $shippingId, $detail = [] )
    {
        $post_array =
            [
            'CustomerID' => $customerId,
            'ShipViaID'  => $shippingId,
            'Detail'     => $detail
        ];

        return $this->Post_API_Signature( 'Get_ShippingRates', 'Get Shipping Rates', $post_array, ['Success', 'Message', 'ShippingRates'], 0 );
    }

    public function Get_View_Return( $customerId, $SalesRep = '', $FromDate = '', $ToDate = '', $RMANo = '', $SalesInvoiceNo = '', $PackingSlipNo = '', $SalesOrderNo = '', $PageIndex = 1, $PageSize = 25 )
    {
        $post_array = array( 'CustomerID' => $customerId, 'SalesRepID' => $SalesRep, 'FromDate' => $FromDate, 'ToDate' => $ToDate, 'RMANo' => $RMANo, 'SalesInvoiceNo' => $SalesInvoiceNo, 'PackingSlipNo' => $PackingSlipNo, 'SalesOrderNo' => $SalesOrderNo, 'PageIndex' => $PageIndex, 'PageSize' => $PageSize );

        return $this->Post_API_Signature( 'Get_RMA', 'Get RMA', $post_array, ['RMAs', 'TotalRows'] );
    }

    public function Login( $email, $password )
    {
        $post_array = array( 'EmailID' => $email, 'Password' => $password );

        return $this->Post_API_Signature( 'Login', 'Login', $post_array, ['UserDetails', 'Success', 'Message'], 0 );
    }

    public function ForgotPassword( $email )
    {
        $post_array = array( 'EmailID' => $email );

        return $this->Post_API_Signature( 'ForgotPassword', 'Forgot Password', $post_array, ['Code', 'Success', 'Message', 'UserID', 'EmailAddress', 'Password'], 0 );
    }

    public function Resetpassword( $UserID, $NewPassword, $OldPassword, $ConfirmPassword )
    {
        $post_array = array( 'UserID' => $UserID, 'NewPassword' => $NewPassword, 'OldPassword' => $OldPassword, 'ConfirmPassword' => $ConfirmPassword );

        return $this->Post_API_Signature( 'Resetpassword', 'Reset Password', $post_array, ['Success', 'Message', 'Code'], 0 );
    }

    public function Get_AllDesign()
    {
        return $this->Post_API_Signature( 'Get_AllDesign', 'Get All Designs', [], ['DesignList', 'Success', 'Message'], 0, 1, 1 );
    }

    public function B2B_GetAllItemsList()
    {
        return $this->Post_API_Signature( 'B2B_GetAllItemsList', 'Get All Items List', [], ['DesignList', 'Success', 'Message'], 0, 1, 1 );
    }

    public function Get_DesignsItemsList( $Design, $CustomerID )
    {
        $post_array = array( 'Design' => $Design, 'CustomerID' => $CustomerID );
        return $this->Post_API_Signature( 'Get_DesignsItemsList', 'Get Designs Items List', $post_array, [], 0 );
    }

    public function Place_Order( $header_data = [], $detail = [] )
    {
        $post_array = [];

        foreach ( $header_data as $key => $value )
        {
            $post_array[$key] = $value;
        }

        $post_array['Detail'] = $detail;

        return $this->Post_API_Signature( 'Place_Order', 'Place Order', $post_array, ['Success', 'Message', 'ErrorDetail', 'ObjectID'], 0 );
    }

    public function Post_API_Signature( $api_slug, $api_text, $post_array, $specific_keys = array(), $only_on_success = 1, $json_reponse = 1, $get_type = 0 )
    {
        $all_params = [
            'api_slug'        => $api_slug,
            'api_text'        => $api_text,
            'post_array'      => $post_array,
            'specific_keys'   => $specific_keys,
            'only_on_success' => $only_on_success,
            'json_reponse'    => $json_reponse,
            'get_type'        => $get_type
        ];
        $cache_key = "{$api_slug}:".md5( serialize( $all_params ) );

        prr( " Method : {$api_slug} - {$api_text}" );
        prr( " API URL : {$this->active_theme->theme_api_base_url}{$api_slug}" );

        if ( in_array( $api_slug, ConstantsController::CACHEABLE ) && Cache::has( $cache_key ) )
        {
            $return = Cache::get( $cache_key );

            prr( "Cache Resposne : ".print_r( $return['response'], 1 ) );

            return $return['response'];
        }
        elseif ( ConstantsController::NON_API_MODE && Storage::disk( 'local' )->exists( $cache_key ) )
        {
            prr( "Local Resposne : ".print_r( json_decode( Storage::get( $cache_key ), 1 ), 1 ) );

            return json_decode( Storage::get( $cache_key ), 1 );
        }
        else
        {
            try
            {

                if ( $get_type == 1 )
                {
                    $request_type = 'get';
                }
                else

                if ( $get_type == 0 )
                {
                    $request_type = 'post';
                }

                $p_array = ["Input" => $post_array];
                //
                $response = Http::timeout( 60 )->withHeaders( $this->accessTokenArray )->$request_type( $this->active_theme->theme_api_base_url.$api_slug, $p_array );

                $ret = null;

                if ( ! count( $specific_keys ) )
                {

                    if ( $json_reponse )
                    {
                        $ret = $response->json();
                    }
                    else
                    {
                        $ret = $response;
                    }

                }
                else
                {
                    $responseArray = $response->json();
                    $s_key         = [];

                    if ( isset( $responseArray['OutPut'] ) )
                    {

                        if (  ( $responseArray['OutPut']['Success'] == true ) || ! $only_on_success )
                        {

                            foreach ( $specific_keys as $specific_key )
                            {

                                if ( isset( $responseArray['OutPut'][$specific_key] ) )
                                {
                                    $s_key[$specific_key] = $responseArray['OutPut'][$specific_key];
                                }

                            }

                        }

                    }
                    else
                    {
                        throw new ConnectionException( "No Output array recieved from API" );
                    }

                    $ret            = $s_key;
                    $ret['Success'] = $responseArray['OutPut']['Success'];
                }

            }
            catch ( ConnectionException $e )
            {
                $s_key = [];

                foreach ( $specific_keys as $specific_key )
                {
                    $s_key[$specific_key] = array();
                }

                $ret = $s_key;
                prr( " API Status: Not Working" );
                prr( " API URL : {$this->active_theme->theme_api_base_url}{$api_slug}" );
                prr( " Exception Message : ".$e->getMessage() );
                prr( " *********************************************************** " );

                if ( strcmp( $api_slug, 'Place_Order' ) === 0 )
                {
                    $ret = [
                        'Exception'   => true,
                        'Success'     => false,
                        'Message'     => 'API SERVICE DOWN...',
                        'ErrorDetail' => [],
                        'ObjectID'    => 999 // defining custom code
                    ];
                }

                if ( in_array( $api_slug, ConstantsController::CACHEABLE ) && $ret )
                {
                    // Cache::put( $cache_key, ['params' => $all_params, 'response' => $ret], now()->addMinutes( ConstantsController::CACHE_DURATION ) );
                }

                return $ret;
            }

            prr( " Request Params : ".print_r( $p_array, 1 ) );
            prr( " JSON Response : ".print_r( $response->json(), 1 ) );

            if ( false && $specific_keys )
            {
                prr( " Specific Keys : ".print_r( $specific_keys, 1 ) );
                prr( " Specific Keys Result : ".print_r( $ret, 1 ) );
            }

            prr( " *********************************************************** " );

            if ( in_array( $api_slug, ConstantsController::CACHEABLE ) )
            {

                if (  ( $ret['Success'] == true ) || ! $only_on_success )
                {
                    Cache::put( $cache_key, ['params' => $all_params, 'response' => $ret], now()->addMinutes( ConstantsController::CACHE_DURATION ) );
                }

            }

            if ( ! $only_on_success || isset( $ret['OutPut'] ) || $ret['Success'] == true )
            {
                Storage::disk( 'local' )->put( $cache_key, json_encode( $ret ) );
            }

            return $ret;
        }

    }

    public function Update_ShippingFreightRate( $salesRepId = 0, $customerId, $rate )
    {
        $post_array = [
            'CustomerID' => $customerId,
            'Rate'       => $rate
        ];

        if ( $salesRepId )
        {
            $post_array['SalesRep'] = $salesRepId;
        }

        return $this->Post_API_Signature( 'Update_ShippingFreightRate', 'Update Shipping Freight Rate', $post_array, ['Success', 'Message', 'CustomerAddress'] );
    }

    public function View_Order( $CustomerID = '', $ExternalID = '', $DateFrom = '', $DateTo = '', $SalesRep = '', $PageIndex = 1, $PageSize = 25, $StatusID = '' )
    {
        $post_array = array( 'CustomerID' => $CustomerID, 'ExternalID' => $ExternalID, 'DateFrom' => $DateFrom, 'DateTo' => $DateTo, 'SalesRep' => $SalesRep, 'PageIndex' => $PageIndex, 'PageSize' => $PageSize, 'StatusID' => $StatusID );

        return $this->Post_API_Signature( 'Get_Orders', 'Ge Order', $post_array, ['Orders', 'TotalRows'] );
    }

    public function __construct()
    {
        parent::__construct();
        try
        {
            $cache_key = 'access_token';
            try {
                $response = '';

                if ( Cache::has( $cache_key ) )
                {
                    $this->accessToken = Cache::get( $cache_key );
                }
                else
                {
                    prr( "Fetching Token..." );
                    $response = Http::timeout( ConstantsController::NON_API_MODE ? 3 : 30 )->get
                        (
                        $this->active_theme->theme_api_base_url.'Get_Token?'.
                        'key='.$this->active_theme->theme_api_key.
                        '&Company='.$this->active_theme->theme_api_company
                    );
                    prr( ['status' => 'Token Received', 'response' => $response->json()] );
                    $this->accessToken = $response->json()['Token'];

                    if ( $this->accessToken )
                    {
                        Cache::put( $cache_key, $this->accessToken, now()->addMinutes( 3 ) );
                    }

                }

            }
            catch ( \Error$e )
            {
                prr( ['error' => $e->getMessage()] );
                prr( "Refetching Token..." );
                $response = Http::timeout( ConstantsController::NON_API_MODE ? 3 : 30 )->get
                    (
                    $this->active_theme->theme_api_base_url.'Get_Token?'.
                    'key='.$this->active_theme->theme_api_key.
                    '&Company='.$this->active_theme->theme_api_company
                );
                prr( ['status' => 'Token Received', 'response' => $response->json()] );
                $this->accessToken = $response->json()['Token'];

                if ( $this->accessToken )
                {
                    Cache::put( $cache_key, $this->accessToken, now()->addMinutes( 3 ) );
                }

            }
            catch ( \Exception$e )
            {
                prr( ['exception' => $e->getMessage()] );
                prr( "Refetching Token..." );
                $response = Http::timeout( ConstantsController::NON_API_MODE ? 3 : 30 )->get
                    (
                    $this->active_theme->theme_api_base_url.'Get_Token?'.
                    'key='.$this->active_theme->theme_api_key.
                    '&Company='.$this->active_theme->theme_api_company
                );
                prr( ['status' => 'Token Received', 'response' => $response->json()] );
                $this->accessToken = $response->json()['Token'];

                if ( $this->accessToken )
                {
                    Cache::put( $cache_key, $this->accessToken, now()->addMinutes( 3 ) );
                }

            }

            $this->accessTokenArray =
                [
                'AccessToken' => $this->accessToken
            ];
        }
        catch ( ConnectionException $e )
        {
            $this->accessToken      = "1111Dummy";
            $this->accessTokenArray =
                [
                'AccessToken' => $this->accessToken
            ];
            prr( " API Status: Not Working" );
            prr( " API URL : {$this->active_theme->theme_api_base_url}Get_Token?key={$this->active_theme->theme_api_key}&Company={$this->active_theme->theme_api_company}" );
            prr( " Exception Message : ".$e->getMessage() );
            prr( "=================================" );

            return;
        }

    }

}
