<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\ConstantsController;

class DesignController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addDesignUrls( $designs, $id, $page = '' )
    {
        $des     = array();
        $counter = 0;

        if ( isset( $designs['Designs'] ) )
        {

            foreach ( $designs['Designs'] as $design )
            {
                $url_link                    = '';
                $des[$counter]               = $design;
                $des[$counter]['LinkUrl']    = route( 'frontend.item', [$id, $design['DesignID'], $design['ColorID']] );
                $des[$counter++]['ImageUrl'] = CommonController::getApiFullImage( $design['ImageName'] );

                if ( empty( $page ) )
                {

                    if ( $counter > ConstantsController::LISTING_LIMIT )
                    {
                        break;
                    }

                }

            }

        }

        return array( 'Designs' => $des, 'TotalRows' => isset( $designs['TotalRows'] ) ? $designs['TotalRows'] : 0 );
    }

    public function check_title_description( $filter )
    {
        $return           = ['title' => '', 'description' => ''];
        $updated_contents = $this->content_model->get_content( '', '', [
            'theme_id' => $this->active_theme->id,
            'endpoint' => 'Get_Collections'
        ] );

        if ( $updated_contents )
        {
            $collection_id = '';
            $filters       = json_decode( CommonController::escape_string( base64_decode( $filter ) ), 1 );

            if ( isset( $filters['Filters'] ) )
            {

                foreach ( $filters['Filters'] as $filter )
                {

                    if ( strcmp( $filter['FilterID'], 'Collection' ) === 0 )
                    {
                        $collection_id = $filter['Values'][0];
                        break;
                    }

                }

            }

            foreach ( $updated_contents as $updated_content )
            {

                if ( $updated_content && $updated_content->content )
                {
                    $contents = json_decode( unserialize( $updated_content->content ), 1 );

                    foreach ( $contents as $content )
                    {

                        if ( strcmp( $collection_id, $content['raw']['CollectionID'] ) === 0 )
                        {
                            $return = [
                                'title'       => $content['title'],
                                'description' => isset( $content['description'] ) ? $content['description'] : ''
                            ];
                            break;
                        }

                    }

                    if ( $return['title'] )
                    {
                        break;
                    }

                }

            }

        }

        return $return;

    }

    public function get_paginated_designs( $id, $filter, $type, $page )
    {
        try {
            return response()->json( array(
                'success' => 1,
                'data'    => $this->addDesignUrls( $this->ApiObj->Get_Designs( $id, base64_decode( $filter ), '', '', '', '', '', '', '', '', '', 30, $page ), $id )
            ) );
        }
        catch ( \Exception$e )
        {
            return response()->json( array( 'success' => 0, 'data' => [] ) );
        }
        catch ( \Error$e )
        {
            return response()->json( array( 'success' => 0, 'data' => [] ) );
        }

    }

    public function index( $id, $filter, $type, $with_title = false )
    {
        if ( base64_decode( $filter ) == ConstantsController::NO_FILTER_FLAG )
        {

            if ( $id == $type )
            {
                $type = 'Collections';
            }

            // this is the case where we land back to the collection controller - this still makes sense

            return redirect()->route( 'frontend.collections', [$id, $type] );
        }

        $collections     = $this->addDesignUrls( $this->ApiObj->Get_Designs( $id, CommonController::escape_string( base64_decode( $filter ), 1 ) ), $id ); //

        $main_collection = ( new MainCollectionController() )->get_main_collection( $id );
        $subCategory     = $this->active_theme_json->general->category_based_filters ? $this->checkSubcategoryForFilters( $filter ) : '';
        $filters         = $this->ApiObj->Get_Filters(
            $main_collection && $main_collection['ParentCollection'] ? $main_collection['ParentCollection'] : $id,
            isset( $subCategory['id'] ) ? $subCategory['id'] : '',
            $this->getSelectedFilters( json_decode( base64_decode( $filter ), true ) )
        );
        $filters    = $this->addSelectedFilters( json_decode( base64_decode( $filter ), true ), $filters );
        $favourites = ( new FavouriteController() )->getFavs( $id );
        // $favourites = ( new FavouriteController() )->getFavs( $main_collection && $main_collection['ParentCollection'] ? $main_collection['ParentCollection'] : $id );

        $this->append_breadcrumbs( $main_collection['Description'], route( 'frontend.favourite', $id ) );
        $this->append_breadcrumbs( "Design", route( 'frontend.designs', [$id, $filter, $type] ) );

        return view( 'frontend.'.$this->active_theme->theme_abrv.'.design', [
            'id'                      => $id,
            'collections'             => $collections,
            'favourites'              => $favourites,
            'main_collection'         => $main_collection,
            'filters'                 => $filters,
            'default_filter'          => base64_decode( $filter ),
            'return_type_id'          => $type,
            'sub_category'            => isset( $subCategory['title'] ) ? $subCategory['title'] : '',
            'with_title'              => $with_title,
            'custom_title_descripton' => $with_title ? $this->check_title_description( $filter ) : []
        ] );
    }

}
