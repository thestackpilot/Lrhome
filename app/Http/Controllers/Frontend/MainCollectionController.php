<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\FrontendController;

class MainCollectionController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_child_collections( $main_collections )
    {
        $mc      = array();
        $counter = 0;

        if ( isset( $main_collections['MainCollections'] ) )
        {

            foreach ( $main_collections['MainCollections'] as $main_collection )
            {

                if ( isset( $main_collection['ParentCollection'] ) )
                {

                    if ( trim( $main_collection['ParentCollection'] ) != '' )
                    {
                        $mc[$counter++] = $main_collection;
                    }

                }

            }

        }

        return array( "MainCollections" => $mc );
    }

    public function get_main_collection( $id )
    {
        $main_collections = $parent_collections = $this->get_main_collections();

        foreach ( $main_collections['MainCollections'] as $main_collection )
        {

            if ( $main_collection['MainCollectionID'] == $id )
            {
                prr( 'COLLECTION ID FOUND: '.print_r( $main_collection, 1 ) );

                return $main_collection;
            }

        }

        prr( 'COLLECTION ID NOT FOUND...' );

        // UA - FUNKARI
        $main_collections = $this->get_sub_collections();

        foreach ( $main_collections['MainCollections'] as $main_collection )
        {

            if ( $main_collection['MainCollectionID'] == $id )
            {

                return $main_collection;
                /*
            foreach ( $parent_collections['MainCollections'] as $parent_collection )
            {

            if ( $parent_collection['MainCollectionID'] == $main_collection['ParentCollection'] )
            {
            prr( 'COLLECTION ID FOUND: '.print_r( $parent_collection, 1 ) );

            return $parent_collection;
            }

            }
             */

            }

        }

    }

    public function get_main_collections()
    {
        return $this->get_parent_collections( $this->ApiObj->Get_Main_Collections() );
    }

    public function get_parent_collections( $main_collections )
    {
        $mc      = array();
        $counter = 0;

        if ( isset( $main_collections['MainCollections'] ) )
        {

            foreach ( $main_collections['MainCollections'] as $main_collection )
            {

                if ( isset( $main_collection['ParentCollection'] ) )
                {

                    if ( trim( $main_collection['ParentCollection'] ) == '' )
                    {
                        $mc[$counter++] = $main_collection;
                    }

                }
                else
                {
                    $mc[$counter++] = $main_collection;
                }

            }

        }

        return array( "MainCollections" => $mc );
    }

    public function get_sub_collections()
    {
        return $this->get_child_collections( $this->ApiObj->Get_Main_Collections() );
    }

    /**
     * Display the landing page of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $main_collections = $this->get_main_collections();
        prr( $main_collections );

        return view( 'frontend.'.$this->active_theme->theme_abrv.'.maincollection', ['main_collections' => $main_collections] );
    }

    public function subcollection()
    {
        $main_collections = $this->get_sub_collections();
        prr( $main_collections );

        return view( 'frontend.'.$this->active_theme->theme_abrv.'.maincollection', ['main_collections' => $main_collections] );
    }

}
