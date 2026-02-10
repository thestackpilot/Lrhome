<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Frontend\MainCollectionController;

class HangtagsController extends DashboardController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function download_print_hangtags( Request $request )
    {
       
        $validated_data = $request->validate( [
            'submit'   => 'required',
            'customer' => 'required',
            'item'     => 'required'
        ] );

        $products = [];

        foreach ( $validated_data['item'] as $k => $item )
        {
            $item       = json_decode( $item, 1 );
            $items_data = $this->ApiObj->Get_GetHangTagsDetailData( $item['ItemID'], $validated_data['customer'], $request->has( 'with-map' ) ? true : '' );

            try {

                if ( $items_data && $items_data['Success'] && $items_data['HangTagsDetail'] )
                {
                    $country = '';
                    $fibers = '';
                    foreach ( $items_data['HangTagsDetail'] as $data )
                    {
                        $country = isset($data['Country']) && !empty($data['Country']) ? $data['Country'] : '';
                        $fibers = isset($data['Fibers']) && !empty($data['Fibers']) ? $data['Fibers'] : '';
                    }

                    $products[$k] = [
                        'category'     => $items_data['HangTagsDetail'][0]['Category'],
                        'title'        => $items_data['HangTagsDetail'][0]['Design'],
                        'attributes'   => [
                            [
                                'label' => 'Material',
                                'value' => $fibers, //$items_data['HangTagsDetail'][0]['Fibers']
                            ],
                            [
                                'label' => 'Country',
                                'value' => $country, //$items_data['HangTagsDetail'][0]['Country']
                            ]
                        ],
                        'construction' => $items_data['HangTagsDetail'][0]['Construction'],
                        'collection'   => $items_data['HangTagsDetail'][0]['Collection'],
                        'image'        => CommonController::getApiFullImage( $item['ImageName'] )
                    ];

                    foreach ( $items_data['HangTagsDetail'] as $i => $data )
                    {
                        $products[$k]['sizes'][$i] = [
                            'label' => $data['SizeDescription'],
                            'price' => ( $request->has( 'price-multiplier' ) && ( $request->{'price-multiplier'} ) > 1 ? $data['UnitPrice'] * ( $request->{'price-multiplier'} ) : $data['UnitPrice'] ),
                            'raw'   => $data
                        ];

                        if ( $request->has( 'round-price' ) )
                        {
                            $round_price = ( $request->{'round-price'} );

                            switch ( $round_price )
                            {
                                case '.00':
                                case .00:
                                    $products[$k]['sizes'][$i]['price'] = ConstantsController::CURRENCY.number_format( round( $products[$k]['sizes'][$i]['price'] ), 2 );
                                    break;
                                case '.99':
                                case .99:
                                    // $products[$k]['sizes'][$i]['price'] = ConstantsController::CURRENCY.number_format( ceil( $products[$k]['sizes'][$i]['price'] / .99 ) * .99, 2 );
                                    $price = $products[$k]['sizes'][$i]['price'];
                                    $roundedPrice = floor($price) - 0.01;
                                    $products[$k]['sizes'][$i]['price'] = ConstantsController::CURRENCY . number_format($roundedPrice, 2);
                                    break;
                                default:
                                    $products[$k]['sizes'][$i]['price'] = ConstantsController::CURRENCY.number_format( $products[$k]['sizes'][$i]['price'], 2 );
                                    break;
                            }

                        }
                        else
                        {
                            $products[$k]['sizes'][$i]['price'] = ConstantsController::CURRENCY.number_format( $products[$k]['sizes'][$i]['price'], 2 );
                        }

                        if ( $request->has( 'include-barcode' ) && ( $request->{'include-barcode'} ) )
                        {
                            $products[$k]['barcodes'][] = [
                                'label' => $data['SizeDescription'],
                                'code'  => $data['UPC']
                            ];
                        }

                    }

                }

            }
            catch ( \Exception $e )
            {
                continue;
            }

        }

        $page_data = [
            'products'      => $products,
            'without_price' => $request->has( 'without-price' ),
            'error_image'   => ConstantsController::IMAGE_PLACEHOLDER,
            'header'        => $request->has( 'header' ) ? $request->header : '',
            'footer'        => $request->has( 'footer' ) && $request->footer ? $request->footer : str_replace(['http://', 'https://'], '', url('/'))
        ];

        if ( $request->hasFile( 'custom-logo' ) && $request->file( 'custom-logo' )->isValid() )
        {
            $file              = $request->file( 'custom-logo' )->move( public_path( 'uploads' ), 'tmpLogo.'.$request->file( 'custom-logo' )->extension() );
            $page_data['logo'] = asset( 'uploads/'.$file->getFileName() );
        }
        else
        {
            $page_data['logo'] = asset( $this->basicSettings->logo_dark );
        }

        switch ( $validated_data['submit'] )
        {
            case 'print':
                $page_data['print'] = true;

                return view( 'dashboard.hangtags-pdf', $page_data );
                break;
            case 'download':
                $html = view( 'dashboard.hangtags-pdf', $page_data )->render();
                $pdf  = PDF::loadHTML( $html )->setPaper( [0, 0, 750, 970], 'portrait' )->setOptions( ['isPhpEnabled' => true, 'isRemoteEnabled' => true] );
                // $pdf = PDF::loadView( 'dashboard.hangtags-pdf', $page_data )->setPaper( [0, 0, 720, 970], 'portrait' )->setOptions( ['isPhpEnabled' => true, 'isRemoteEnabled' => true] );

                return $pdf->download( 'hangtags.pdf' );
                break;
            default:
                return redirect()->route( 'dashboard.hangtags' )->with( 'message', ['type' => 'danger', 'body' => 'Invalid request.'] );
                break;
        }

    }

    public function fetch_hangtags( Request $request )
    {
        $validated_data = $request->validate( [
            'search-type' => 'required',
            'customer'    => 'required'
        ] );
        $items = [];

        switch ( $validated_data['search-type'] )
        {
            case 'user-search':
                $params = [
                    'collection' => $request->has( 'collections' ) ? $request->collections : '',
                    'design'     => $request->has( 'designs' ) ? $request->designs : '',
                    'color'      => $request->has( 'colors' ) ? $request->colors : ''
                ];
                $items = $this->ApiObj->Get_GetHangTagsSearchData( $params['collection'], $params['design'], $params['color'] );
                $items = $items['HangTags'] ? $items['HangTags'] : [];
                break;
            case 'file-upload':

                if ( $request->hasFile( 'csv-file' ) && $request->file( 'csv-file' )->isValid() )
                {
                    $data = array_map( 'str_getcsv', file( $request->file( 'csv-file' )->getPathname() ) );

                    if ( strstr( strtolower( $data[0][0] ), 'design' ) )
                    {

                        foreach ( $data as $k => $row )
                        {

                            if ( $k < 1 )
                            {
                                continue;
                            }

                            if ( isset( $row[0] ) && $row[0] )
                            {

                                $hangtag = $this->ApiObj->Get_GetHangTagsSearchData( '', $row[0], '' );

                                if ( isset( $hangtag['HangTags'] ) )
                                {
                                    $items = array_merge( $items, $hangtag['HangTags'] );
                                }

                            }

                        }

                    }
                    else
                    {
                        return redirect()->route( 'dashboard.hangtags' )->with( 'message', ['type' => 'danger', 'body' => '".CSV" format is not valid.'] );
                    }

                }
                else
                {
                    return redirect()->route( 'dashboard.hangtags' )->with( 'message', ['type' => 'danger', 'body' => 'Please attach a valid ".CSV" file.'] );
                }

                break;
            case 'csv-designs':

                if ( $request->has( 'csv-designs' ) && ( $request->    {'csv-designs'} ) )
                {
                    $data = explode( ',', ( $request->    {'csv-designs'} ) );

                    foreach ( $data as $k => $row )
                    {

                        if ( trim( $row ) )
                        {
                            $hangtag = $this->ApiObj->Get_GetHangTagsSearchData( '', trim( $row ), '' );

                            if ( isset( $hangtag['HangTags'] ) )
                            {
                                $items = array_merge( $items, $hangtag['HangTags'] );
                            }

                        }

                    }

                }
                else
                {
                    return redirect()->route( 'dashboard.hangtags' )->with( 'message', ['type' => 'danger', 'body' => 'Invalid value provided.'] );
                }

                break;
            default:
                return redirect()->route( 'dashboard.hangtags' )->with( 'message', ['type' => 'danger', 'body' => 'Invalid request.'] );
                break;
        }

        return view( 'dashboard.hangtags', [
            'collections' => [],
            'mode'        => 'fetch',
            'customer'    => $request->customer,
            'items'       => $items ? $items : []
        ] );
    }

    public function get_collection_designs( Request $request )
    {
        $validated_data = $request->validate( [
            'collection'     => 'required',
        ] );
        $designs = $this->ApiObj->Get_OrderInquiryData( '', '', $validated_data['collection'], '', '', '' );

        return response()->json( array(
            'success' => 0,
            'data'    => $designs
        ), 200 );
    }

    public function get_collection_colors( Request $request )
    {
        $validated_data = $request->validate( [
            'collection'     => 'required',
            'design'         => 'required'
        ] );
        $colors = $this->ApiObj->Get_OrderInquiryData( '', '', $validated_data['collection'], $validated_data['design'], '', '' );

        return response()->json( array(
            'success' => 0,
            'data'    => $colors
        ), 200 );
    }

    public function index()
    {

        if ( ! $this->active_theme_json->general->allow_hang_tags )
        {
            return redirect( route( 'dashboard' ) );
        }

        $customers        = $this->get_customers_dropdown_options( false );
        $main_collections = ( new MainCollectionController() )->get_main_collections();
        $collections      = [];

        // foreach ( $main_collections['MainCollections'] as $k => $main_collection )
        // {
        //     $collections[$k]['parent'] = $main_collection;
        //     $collections[$k]['childs'] = $this->ApiObj->Get_Collections( $main_collection['MainCollectionID'] );
        // }
        $collections = $this->ApiObj->Get_OrderInquiryData( '', '', '', '', '', '' );

        return view( 'dashboard.hangtags', ['collections' => $collections, 'items' => [], 'mode' => 'search', 'customers' => $customers] );
    }

    public function redirect_to_index()
    {
        return redirect()->route( 'dashboard.hangtags' );
    }

}
