<?php

namespace App\Http\Controllers\Frontend;

//Laravel macros
use View;
//Application Models
use App\Models\Cart;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Slider;
use App\Models\Showrooms;
use App\Models\BasicSetting;
use App\Models\ApiContentManagement;
//Base Controllers
use App\Http\Controllers\ApisController;
//Base View
use App\Http\Controllers\RootController;
use App\Http\Controllers\CommonController;

class FrontendController extends RootController
{
    public $ApiObj;

    public $breadcrumbs;

    public $content_model;

    protected $menus;

    public function __construct()
    {
        parent::__construct();
        $this->ApiObj        = new ApisController();
        $this->content_model = new ApiContentManagement();
        $basicSettings       = ( new BasicSetting() )->get_settings( $this->active_theme->id );
        View::share( 'basicSettings', $basicSettings );

        $this->menus = CommonController::convert_array_to_obj_recursive(  ( new Menu() )->get_menus_with_meta( $this->active_theme->id ) );
        View::share( 'menus', $this->menus );

        $sliders = CommonController::convert_array_to_obj_recursive(  ( new Slider() )->get_sliders_with_meta( $this->active_theme->id ) );
        View::share( 'sliders', $sliders );

        $showrooms = CommonController::convert_array_to_obj_recursive(  ( new Showrooms() )->get_showrooms_with_meta( $this->active_theme->id ) );
        View::share( 'showrooms', $showrooms );

        $pages = CommonController::convert_array_to_obj_recursive(  ( new Page() )->get_pages_with_sections( $this->active_theme->id ) );
        View::share( 'pages', $pages );

        $cart = CommonController::convert_array_to_obj_recursive(  ( new Cart() )->get_cart_for_front( $this->ApiObj ) );
        View::share( 'cart', $cart );

        $this->breadcrumbs = array(
            "Home" => route( 'frontend.home' )
        );
        View::share( 'breadcrumbs', $this->breadcrumbs );
    }

    public function addSelectedFilters( $selected_filters, $filters )
    {

        if ( ! is_array( $selected_filters ) )
        {
            $selected_filters = array( 'Filters' => array() );
        }

        $badge_colors     = array( 'bg-primary', 'bg-secondary', 'bg-success', 'bg-danger', 'bg-warning', 'bg-info', 'bg-dark' );
        $sel              = array();
        $sel_filter_count = 0;
        $filter_count     = 0;
        $counter          = 0;

        if ( isset( $filters['Filters'] ) )
        {

            foreach ( $filters['Filters'] as $filter )
            {
                $sel[$counter] = $filter;
                $val           = array();
                $icounter      = 0;

                foreach ( $filter['Values'] as $value )
                {
                    $val[$icounter] = array( 'value' => $value, 'checked' => 0, 'color_code' => 'bg-dark' ); //$badge_colors[array_rand($badge_colors)]
                    $filter_count++;

                    foreach ( $selected_filters['Filters'] as $selected_filter )
                    {

                        if ( trim( $selected_filter['FilterID'] ) == trim( $filter['FilterID'] ) )
                        {

                            foreach ( $selected_filter['Values'] as $selected_value )
                            {

                                if ( trim( $value ) == trim( $selected_value ) )
                                {
                                    $val[$icounter] = array( 'value' => $value, 'checked' => 1, 'color_code' => 'bg-dark' );
                                    $sel_filter_count++;
                                    break;
                                }

                            }

                        }

                    }

                    $icounter++;
                }

                $sel[$counter++]['Values'] = $val;
            }

        }

        return array( 'Filters' => $sel, 'Filters_Count' => $filter_count, 'Selected_Filters_Count' => $sel_filter_count );
    }

    public function append_breadcrumbs( $key, $value )
    {  
        $this->breadcrumbs[$key] = $value;
        View::share( 'breadcrumbs', $this->breadcrumbs );
    }

    public function checkSubcategoryForFilters( $filter )
    {
        $subCategory = ['id' => '', 'title' => ''];
        $menus       = $this->getAllMenusTitles();
        $filters     = json_decode( base64_decode( $filter ), 1 );

        if ( ! is_array( $filters ) )
        {
            return '';
        }

        foreach ( $filters['Filters'] as $filter )
        {

            if ( strtolower( $filter['FilterID'] ) == 'construction' )
            {
                $filter['FilterID'] = 'Machine Made';
            }

            if ( array_key_exists( strtolower( $filter['FilterID'] ), $menus ) )
            {
                $subCategory = [
                    'id'    => str_replace( '_', ' ', $filter['FilterID'] ),
                    'title' => $menus[strtolower( $filter['FilterID'] )]
                ];
                break;
            }

        }

        $custom = [
            'naturals'       => 'SHOP NATURALS',
            'indoor outdoor' => 'INDOOR & OUTDOOR COLLECTIONS',
            'machine made'   => 'MACHINE MADE COLLECTIONS'
        ];

        foreach ( $custom as $key => $value )
        {

            if ( strtolower( $subCategory['id'] ) == $key )
            {
                $subCategory['title'] = $value;
            }

        }

        return $subCategory;
    }

    public function getAllMenusTitles()
    {
        $menus       = [];
        $menus_metas = [
            $this->menus->rug_shop_header->metas,
            $this->menus->rug_header->metas,
            $this->menus->pillow_header->metas,
            $this->menus->pillow_shop_header->metas,
            $this->menus->pet_header->metas,
            $this->menus->furniture_header->metas,
            $this->menus->dining_header->metas,
            $this->menus->outdoor_header->metas
        ];

        foreach ( $menus_metas as $metas )
        {

            foreach ( $metas as $meta )
            {

                if ( ! in_array( $meta->meta_key, $menus ) )
                {
                    $menus[strtolower( $meta->meta_key )] = $meta->meta_title;
                }

            }

        }

        return $menus;

    }

    public function getSelectedFilters( $filters )
    {
        $selected_filters = [];

        if ( ! is_array( $filters ) )
        {
            $filters = array( 'Filters' => array() );
        }

        if ( isset( $filters['Filters'] ) )
        {

            foreach ( $filters['Filters'] as $filter )
            {
                $selected_filters[$filter['FilterID']] = join( ',', $filter['Values'] );

            }

        }

        return $selected_filters;

    }

}
