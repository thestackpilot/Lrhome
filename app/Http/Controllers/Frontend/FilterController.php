<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\CommonController;
use App\Http\Controllers\Frontend\FrontendController;

class FilterController extends FrontendController
{
    public $design;

    public function __construct()
    {
        parent::__construct();
        $this->design = new DesignController();
    }

    public function addFilterUrls( $results, $filter )
    {
        $ret     = array();
        $counter = 0;

        foreach ( $results['OutPut'] as $result )
        {
            $ret[$counter]            = $result;
            $ret[$counter]['Designs'] = $result[$filter];
            unset( $ret[$counter][$filter] );
            $temp                       = $this->design->addDesignUrls( $ret[$counter], $result['MainCollectionID'] );
            $ret[$counter++]['Designs'] = $temp['Designs'];
        }

        return $ret;
    }

    public function check_filters()
    {
        //
    }

    public function get_sort_filter( $filters )
    {
        $sort_order = '';
        $filters    = json_decode( $filters, 1 );

        if ( $filters )
        {

            foreach ( $filters['Filters'] as $k => $filter )
            {

                if ( strtolower( $filter['FilterID'] ) === 'sort' )
                {
                    $sort_order = $filter['Values'][0];
                    unset( $filters['Filters'][$k] );
                    $filters['Filters'] = array_values($filters['Filters']);
                }

            }

        }

        return [CommonController::escape_string( json_encode( $filters ), 1 ), $sort_order];
        // return ['filters' => $filters, 'sort_order' => $sort_order];

    }

    public function index( $type )
    {
        $filterpages = $this->addFilterUrls( $this->ApiObj->Get_FilterPages( 0, $type ), $type );
        $title       = $type;

        switch ( $type )
        {
            case 'NewArrivals':
                $title = 'New Arrivals';
                break;
            case 'TopSellers':
                $title = 'Top Sellers';
                break;
            case 'SpecialBuys':
                $title = 'Special Buys';
                break;
            case 'RecycledProducts':
                $title = 'Recycled Products';
                break;
            case 'DonnyOsmondHomes':
                $title = 'Donny Osmond Homes';
                break;
            case 'Discontinueds':
                $title = 'Discontinueds';
                break;
        }

        $this->append_breadcrumbs( $type, route( 'frontend.filters', [$type] ) );

        return view( 'frontend.'.$this->active_theme->theme_abrv.'.filterpage', ['filter_page' => 1, 'type' => '', 'filterpages' => $filterpages, 'view_title' => $title] );
    }

}
