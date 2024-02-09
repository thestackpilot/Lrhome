<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\Frontend\FrontendController;

class FavouriteController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addFavsUrls( $favourites, $id )
    {
        $favs    = array();
        $counter = 0;

        if ( isset( $favourites['Favourities'] ) )
        {

            foreach ( $favourites['Favourities'] as $favourite )
            {
                $url_link = '';

                if ( strtolower( $favourite['LinkPage'] ) == 'designs' )
                {
                    $url_link = route( 'frontend.designs', [$id, base64_encode( $favourite['LinkFilter'] ), 0] );
                }
                else
                {
                    $url_link = route( 'frontend.collections', [$id, $favourite['LinkPage']] );

                    if ( isset( $favourite['LinkFilter'] ) && $favourite['LinkFilter'] )
                    {
                        $url_link = route( 'frontend.collection_with_filters', [$id, $favourite['LinkPage'], base64_encode( $favourite['LinkFilter'] )] );
                    }

                }

                $favs[$counter]              = $favourite;
                $favs[$counter++]['LinkUrl'] = $url_link;
            }

        }

        return array( 'Favourities' => $favs );
    }

    public function getFavs( $id )
    {
        return $this->addFavsUrls( $this->ApiObj->Get_Favourities( $id ), $id );
    }

    public function index( $id )
    {
        $hash            = md5( json_encode( ['id' => $id, 'method' => 'Get_Favourities', 'theme' => $this->active_theme->id] ) );
        $favourites      = $this->addFavsUrls( $this->ApiObj->Get_Favourities( $id ), $id );
        $updated_content = $this->content_model->get_content( $this->active_theme->id, $hash );

        if ( $updated_content && $updated_content->content )
        {
            $content = json_decode( unserialize( $updated_content->content ), 1 );

            foreach ( $favourites['Favourities'] as &$favourite )
            {

                if ( array_key_exists( $favourite['Title'], $content ) )
                {
                    $key                = $favourite['Title'];
                    $favourite['Image'] = $content[$key]['image'];
                    $favourite['Title'] = $content[$key]['title'];
                }

            }

        }

        // die( '<pre>'.print_r( $favourites, 1 ) );
        $filters = $this->ApiObj->Get_Filters( $id );
        $filters = $this->addSelectedFilters( ConstantsController::NO_FILTER_FLAG, $filters );

        $main_collection = ( new MainCollectionController() )->get_main_collection( $id );
        // prr( ['MAIN COLLECTION' => $main_collection] );
        $this->append_breadcrumbs( $main_collection['Description'], route( 'frontend.favourite', $id ) );

        return view( 'frontend.'.$this->active_theme->theme_abrv.'.favourite', ['favourites' => $favourites, 'main_collection' => $main_collection, 'filters' => $filters, 'return_type_id' => $id] );
    }

    public function static_fav_page( $type )
    {

        $favourites = ['Favourities' => []];

        switch ( strtolower( $type ) )
        {
            case 'outdoor':
                $favourites = ['Favourities' => [
                    [
                        'Title'      => 'RUGS',
                        'LinkTag'    => 'Get_Collections',
                        'LinkFilter' => '{"Filters": [{"FilterID": "Indoor_Outdoor","Values": ["Indoor_Outdoor"]}]}',
                        'LinkPage'   => 'Collections',
                        'Image'      => 'images/landing-img/outdoor/1.png',
                        'LinkUrl'    => url( '/collections/Rugs/Collections/'.base64_encode( '{"Filters": [{"FilterID": "Indoor_Outdoor","Values": ["Indoor_Outdoor"]}]}' ) )
                    ],
                    [
                        'Title'      => 'PILLOWS',
                        'LinkTag'    => 'Get_Designs',
                        'LinkFilter' => '{"Filters": [{"FilterID": "PILLOWS","Values": ["PILLOWS"]},{"FilterID": "Indoor_Outdoor","Values": ["Indoor_Outdoor"]}]}',
                        'LinkPage'   => 'Designs',
                        'Image'      => 'images/landing-img/outdoor/2.png',
                        'LinkUrl'    => url( '/designs/Pillows%20&%20Decor/'.base64_encode( '{"Filters": [{"FilterID": "PILLOWS","Values": ["PILLOWS"]},{"FilterID": "Indoor_Outdoor","Values": ["Indoor_Outdoor"]}]}' ).'/0' )
                    ],
                    [
                        'Title'      => 'POUFS',
                        'LinkTag'    => 'Get_Designs',
                        'LinkFilter' => '{"Filters": [{"FilterID": "POUFS","Values": ["POUFS"]},{"FilterID": "Indoor_Outdoor","Values": ["Indoor_Outdoor"]}]}',
                        'LinkPage'   => 'Designs',
                        'Image'      => 'images/landing-img/outdoor/1.png',
                        'LinkUrl'    => url( '/designs/Pillows%20&%20Decor/'.base64_encode( '{"Filters": [{"FilterID": "POUFS","Values": ["POUFS"]},{"FilterID": "Indoor_Outdoor","Values": ["Indoor_Outdoor"]}]}' ).'/0' )
                    ],
                    [
                        'Title'      => 'Baskets',
                        'LinkTag'    => 'Get_Designs',
                        'LinkFilter' => '{"Filters": [{"FilterID": "Baskets","Values": ["Baskets"]},{"FilterID": "Indoor_Outdoor","Values": ["Indoor_Outdoor"]}]}',
                        'LinkPage'   => 'Designs',
                        'Image'      => 'images/landing-img/outdoor/4.jpg',
                        'LinkUrl'    => url( '/designs/Pillows%20&%20Decor/'.base64_encode( '{"Filters": [{"FilterID": "Baskets","Values": ["Baskets"]},{"FilterID": "Indoor_Outdoor","Values": ["Indoor_Outdoor"]}]}' ).'/0' )
                    ]
                ]];
                break;
        }

        // prr( $favourites );
        $filters = $this->ApiObj->Get_Filters( $type );
        $filters = $this->addSelectedFilters( ConstantsController::NO_FILTER_FLAG, $filters );

        $main_collection = ( new MainCollectionController() )->get_main_collection( $type );

        if ( ! $main_collection )
        {
            $main_collection = ['Description' => ucwords( $type )];
        }

        // prr( ['MAIN COLLECTION' => $main_collection] );
        $this->append_breadcrumbs( $main_collection['Description'], route( 'frontend.favourite', $type ) );

        return view( 'frontend.'.$this->active_theme->theme_abrv.'.favourite', [
            'favourites'      => $favourites,
            'main_collection' => $main_collection,
            'filters'         => $filters,
            'return_type_id'  => $type
        ] );
    }

}
