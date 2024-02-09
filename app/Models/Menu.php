<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    protected $fillable = ['theme_id', 'name', 'slug'];

    /*protected $table = 'menu';*/
    private $meta_model;

    public function __construct()
    {
        $this->meta_model = new MenuMeta();
    }

    // get main menus
    public function get_main_menus( $theme_id )
    {
        return $this->where( 'theme_id', $theme_id )->get();
    }

    public function get_menu_with_meta( $menu_id )
    {
        return $this->where( 'id', $menu_id )->with( 'menu_metas' )->first(); //use dynamic bindings

    }

    public function get_menus_with_meta( $theme_id )
    {
        $final_array = [];
        $menus       = $this->where( 'theme_id', $theme_id )->get();

        if ( ! $menus->isEmpty() )
        {
            $final_array = $this->array_slug_to_outter_key( $menus->toArray() );

            foreach ( $final_array as $key => $value )
            {

                $value['metas']    = $this->get_menu_meta_for_front( $value );
                $final_array[$key] = $value;

            }

        }

        return $final_array;

    }

    public function get_menus_with_meta_raw()
    {
        return (object) array
            (
            "mega_header"   => (object) array
            (
                "slug"  => "mega_header",
                "name"  => "Product",
                "metas" => (object) array
                (
                    "rugs"    => (object) array
                    (
                        "meta_key"        => "rugs",
                        "meta_title"      => "Rugs",
                        "meta_url"        => "https://rizzyhome.ashtexsolutions.com/category/1",
                        "meta_image"      => "https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-1.jpg",
                        "meta_parent_key" => ""
                    ),
                    "pillows" => (object) array
                    (
                        "meta_key"        => "pillows",
                        "meta_title"      => "Pillows",
                        "meta_url"        => "https://rizzyhome.ashtexsolutions.com/category/2",
                        "meta_image"      => "https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-2.jpg",
                        "meta_parent_key" => ""
                    ),
                    "bedding" => (object) array
                    (
                        "meta_key"        => "bedding",
                        "meta_title"      => "Bedding",
                        "meta_url"        => "https://rizzyhome.ashtexsolutions.com/category/3",
                        "meta_image"      => "https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-3.jpg",
                        "meta_parent_key" => ""
                    )
                )

            ),
            "main_header"   => (object) array
            (
                "slug"  => "main_header",
                "name"  => "Main Header",
                "metas" => (object) array
                (
                    "new_additions" => (object) array
                    (
                        "meta_key"        => "new_additions",
                        "meta_title"      => "New Additions",
                        "meta_url"        => "https://rizzyhome.ashtexsolutions.com/category/1",
                        "meta_image"      => "https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-1.jpg",
                        "meta_parent_key" => ""
                    ),
                    "catalog"       => (object) array
                    (
                        "meta_key"        => "catalog",
                        "meta_title"      => "Catalogue",
                        "meta_url"        => "https://rizzyhome.ashtexsolutions.com/category/2",
                        "meta_image"      => "https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-2.jpg",
                        "meta_parent_key" => "",
                        "metas"           => (object) array
                        (
                            "become_a_dealer" => (object) array
                            (
                                "meta_key"        => "become_a_dealer",
                                "meta_title"      => "Become A Dealer",
                                "meta_url"        => "https://rizzyhome.ashtexsolutions.com/category/3",
                                "meta_image"      => "https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-3.jpg",
                                "meta_parent_key" => "catalog"
                            )
                        )
                    )
                )
            ),
            "first_footer"  => (object) array
            (
                "slug"  => "first_footer",
                "name"  => "Products",
                "metas" => (object) array
                (
                    "rugs" => (object) array
                    (
                        "meta_key"        => "rugs",
                        "meta_title"      => "Rugs",
                        "meta_url"        => "https://rizzyhome.ashtexsolutions.com/category/1",
                        "meta_image"      => "https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-1.jpg",
                        "meta_parent_key" => ""
                    )
                )
            ),
            "second_footer" => (object) array
            (
                "slug"  => "second_footer",
                "name"  => "Quick Services",
                "metas" => (object) array
                (
                    "pillows" => (object) array
                    (
                        "meta_key"        => "piilows",
                        "meta_title"      => "Pillows",
                        "meta_url"        => "https://rizzyhome.ashtexsolutions.com/category/2",
                        "meta_image"      => "https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-2.jpg",
                        "meta_parent_key" => ""
                    )
                )
            ),
            "third_footer"  => (object) array
            (
                "slug"  => "third_footer",
                "name"  => "Company Info",
                "metas" => (object) array
                (
                    "throws" => (object) array
                    (
                        "meta_key"        => "throws",
                        "meta_title"      => "Throws",
                        "meta_url"        => "https://rizzyhome.ashtexsolutions.com/category/3",
                        "meta_image"      => "https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-3.jpg",
                        "meta_parent_key" => ""
                    )
                )
            )
        );
    }

    public function get_menus_with_meta_raw_lr()
    {
        return (object) array
            (
            "rug_header"            => (object) array
            (
                "slug"  => "rug_header",
                "name"  => "Rugs",
                "metas" => (object) array
                (
                    "new_addition"    => (object) array
                    (
                        "meta_key"        => "new_addition",
                        "meta_title"      => "View Additions",
                        "meta_url"        => "https://rizzyhome.ashtexsolutions.com/category/1",
                        "meta_parent_key" => ""

                    ),
                    "view_collection" => (object) array
                    (
                        "meta_key"        => "view_collection",
                        "meta_title"      => "View Collection",
                        "meta_url"        => "https://rizzyhome.ashtexsolutions.com/category/2",
                        "meta_parent_key" => ""

                    )

                )

            ),
            "rug_shop_header"       => (object) array
            (
                "slug"  => "rug_shop_header",
                "name"  => "Rugs",
                "metas" => (object) array
                (
                    "machine_made" => (object) array
                    (
                        "meta_key"        => "machine_made",
                        "meta_title"      => "Shop Machine Made",
                        "meta_url"        => "https://rizzyhome.ashtexsolutions.com/category/1",
                        "meta_image"      => "LR/images/coffee-table.jpg",
                        "meta_parent_key" => ""

                    )
                )
            ),

            "pillow_header"         => (object) array
            (
                "slug"  => "pillow_header",
                "name"  => "Home Decor",
                "metas" => (object) array
                (
                    "home_decor" => (object) array
                    (
                        "meta_key"        => "home_decor",
                        "meta_title"      => "Home Decor",
                        "meta_url"        => "",
                        "meta_image"      => "",
                        "meta_parent_key" => ""

                    ),
                    "pets"       => (object) array
                    (
                        "meta_key"        => "pets",
                        "meta_title"      => "Pets",
                        "meta_url"        => "",
                        "meta_image"      => "",
                        "meta_parent_key" => ""

                    )

                )

            ),

            "pillow_shop_header"    => (object) array
            (
                "slug"  => "pillow_shop_header",
                "name"  => "Shop Pillows",
                "metas" => (object) array
                (
                    "shop_pillow" => (object) array
                    (
                        "meta_key"        => "shop_pillow",
                        "meta_title"      => "Shop Pillows",
                        "meta_url"        => "LR/images/pillows.jpg",
                        "meta_image"      => "LR/images/coffee-table.jpg",
                        "meta_parent_key" => ""

                    )
                )
            ),

            "furniture"             => (object) array
            (
                "slug"  => "furniture",
                "name"  => "Furniture",
                "metas" => (object) array
                (
                    "accent_chairs" => (object) array
                    (
                        "meta_key"   => "accent_chairs",
                        "meta_title" => "Accent Chairs",
                        "meta_url"   => "https://rizzyhome.ashtexsolutions.com/category/1"
                    ),
                    "cabinets"      => (object) array
                    (
                        "meta_key"   => "cabines",
                        "meta_title" => "Cabinets",
                        "meta_url"   => "https://rizzyhome.ashtexsolutions.com/category/2"
                    ),
                    "benches"       => (object) array
                    (
                        "meta_key"        => "benches",
                        "meta_title"      => "Benches",
                        "meta_url"        => "https://rizzyhome.ashtexsolutions.com/category/3",
                        "meta_image"      => "https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-3.jpg",
                        "meta_parent_key" => ""
                    )
                )

            ),

            "furniture_shop_header" => (object) array
            (
                "slug"  => "furniture_shop_header",
                "title" => "Shop Furnture",
                "metas" => (object) array
                (
                    "shop_furniture" => (object) array
                    (
                        "meta_key"        => "shop_furniture",
                        "meta_title"      => "Furniture",
                        "meta_url"        => "LR/images/pillows.jpg",
                        "meta_image"      => "LR/images/coffee-table.jpg",
                        "meta_parent_key" => ""

                    )
                )
            ),

            "outdoor"               => (object) array
            (
                "slug"  => "outdoor",
                "name"  => "Outdoor",
                "metas" => (object) array
                (
                    "basket"  => (object) array
                    (
                        "meta_key"   => "accent_chairs",
                        "meta_title" => "Accent Chairs",
                        "meta_url"   => "https://rizzyhome.ashtexsolutions.com/category/1"
                    ),
                    "rugs"    => (object) array
                    (
                        "meta_key"        => "cabines",
                        "meta_title"      => "Cabinets",
                        "meta_url"        => "https://rizzyhome.ashtexsolutions.com/category/2",
                        "meta_image"      => "",
                        "meta_parent_key" => ""

                    ),
                    "pillows" => (object) array
                    (
                        "meta_key"        => "benches",
                        "meta_title"      => "Benches",
                        "meta_url"        => "https://rizzyhome.ashtexsolutions.com/category/3",
                        "meta_image"      => "https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-3.jpg",
                        "meta_parent_key" => ""
                    )
                )

            ),

            "outdoor_shop_header"   => (object) array
            (
                "slug"  => "outdoor_shop_header",
                "title" => "Outdoor",
                "metas" => (object) array
                (
                    "shop_outdoor" => (object) array
                    (
                        "meta_key"        => "shop_outdoor",
                        "meta_title"      => "Outdoor",
                        "meta_url"        => "LR/images/pillows.jpg",
                        "meta_image"      => "LR/images/coffee-table.jpg",
                        "meta_parent_key" => ""

                    )
                )
            ),

            "about_us"              => (object) array
            (
                "slug"  => "about_us",
                "title" => "About Us",
                "metas" => (object) array
                (
                    "story"   => (object) array
                    (
                        "meta_key"        => "cabines",
                        "meta_title"      => "Cabinets",
                        "meta_url"        => "https://rizzyhome.ashtexsolutions.com/category/2",
                        "meta_image"      => "https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-3.jpg",
                        "meta_parent_key" => ""

                    ),
                    "purpose" => (object) array
                    (
                        "meta_key"        => "benches",
                        "meta_title"      => "Benches",
                        "meta_url"        => "https://rizzyhome.ashtexsolutions.com/category/3",
                        "meta_image"      => "https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-3.jpg",
                        "meta_parent_key" => ""
                    )
                )

            ),

            "first_footer"          => (object) array
            (
                "slug"  => "first_footer",
                "name"  => "About Us",
                "metas" => (object) array
                (
                    "become_partner"  => (object) array
                    (
                        "meta_key"        => "become_partner",
                        "meta_title"      => "Become a Partner33",
                        "meta_url"        => "https://rizzyhome.ashtexsolutions.com/category/1",
                        "meta_image"      => "",
                        "meta_parent_key" => ""
                    ),

                    "become_partner2" => (object) array
                    (
                        "meta_key"        => "become_partner2",
                        "meta_title"      => "Become a Partner 2",
                        "meta_url"        => "https://rizzyhome.ashtexsolutions.com/category/1",
                        "meta_image"      => "",
                        "meta_parent_key" => ""
                    )
                )
            ),

            "second_footer"         => (object) array
            (
                "slug"  => "second_footer",
                "title" => "Product Category",
                "metas" => (object) array
                (
                    "rugs" => (object) array
                    (
                        "meta_key"        => "rugs",
                        "meta_title"      => "Rugs",
                        "meta_url"        => "https://rizzyhome.ashtexsolutions.com/category/1",
                        "meta_image"      => "",
                        "meta_parent_key" => ""
                    )
                )
            ),
            "third_footer"          => (object) array
            (
                "slug"  => "third_footer",
                "title" => "Resources",
                "metas" => (object) array
                (
                    "catalog_2021" => (object) array
                    (
                        "meta_key"        => "catalog_2021",
                        "meta_title"      => "Catalog",
                        "meta_url"        => "https://rizzyhome.ashtexsolutions.com/category/2",
                        "meta_image"      => "",
                        "meta_parent_key" => ""
                    )
                )
            ),
            "fourth_footer"         => (object) array
            (
                "slug"  => "fourth_footer",
                "title" => "Contact Us",
                "metas" => (object) array
                (
                    "contact_us" => (object) array
                    (
                        "meta_key"        => "contact_us",
                        "meta_title"      => "Contact Us",
                        "meta_url"        => "https://rizzyhome.ashtexsolutions.com/category/3",
                        "meta_image"      => "",
                        "meta_parent_key" => ""
                    )
                )
            ),
            "fifth_footer"          => (object) array
            (
                "slug"  => "fifth_footer",
                "title" => "Get Inspired",
                "metas" => (object) array
                (
                    "throws" => (object) array
                    (
                        "meta_key"        => "inspired",
                        "meta_title"      => "Inspired",
                        "meta_url"        => "https://rizzyhome.ashtexsolutions.com/category/3",
                        "meta_image"      => "",
                        "meta_parent_key" => ""
                    )
                )
            )
        );

    }

    public function menu_metas()
    {
        return $this->hasMany( MenuMeta::class );
    }

    // save or update menus and meta
    public function save_or_update_menus( $theme_id, $menus )
    {
        $this->soft_delete_not_exist_menus( $theme_id, $menus );

        foreach ( $menus as $menu )
        {
            $result_obj = $this->updateOrCreate(
                ['theme_id' => $theme_id, 'slug' => $menu->slug],
                ['theme_id' => $theme_id, 'name' => $menu->title, 'slug' => $menu->slug]
            );
        }

    }

    public function update_is_active( $menu_id, $is_active )
    {
        $this->where( 'id', $menu_id )->update( ['is_active' => $is_active] );
    }

    //-----The cache / session functions
    private function array_slug_to_outter_key( $array )
    {
        $array_with_keys = [];

        foreach ( $array as $index )
        {

            if ( $index['is_active'] )
            {
                $array_with_keys[$index['slug']] = $index;
            }

        }

        return $array_with_keys;
    }

    private function get_menu_meta_for_front( $menu )
    {
        $array_to_return   = [];
        $parent_menu_metas = $this->meta_model->where( 'menu_id', $menu['id'] )->where( 'meta_parent_key', null )->get();

        if ( ! $parent_menu_metas->isEmpty() )
        {
            $array_to_return = $this->menu_meta_key_to_outter_key( $parent_menu_metas->toArray() );

            foreach ( $array_to_return as $key => $value )
            {
                $result_child_metas = $this->meta_model->where( 'meta_parent_key', $value['meta_key'] )->get();

                if ( ! $result_child_metas->isEmpty() )
                {
                    $result_child_metas    = $this->menu_meta_key_to_outter_key( $result_child_metas->toArray() );
                    $value['metas']        = $result_child_metas;
                    $array_to_return[$key] = $value;
                }

            }

        }

        return $array_to_return;
    }

    private function menu_meta_key_to_outter_key( $array )
    {
        $array_with_keys = [];

        foreach ( $array as $index )
        {
            $array_with_keys[$index['meta_key']] = $index;
        }

        return $array_with_keys;
    }

    // soft Delete menu that no longer in theme
    private function soft_delete_not_exist_menus( $theme_id, $menus )
    {
        $not_existing_menu_ids = [];
        $all_menus_from_db     = $this->where( 'theme_id', $theme_id )->select( 'id' )->get();

        if ( ! $all_menus_from_db->isEmpty() )
        {
            $all_menus_from_db = array_column( $all_menus_from_db->toArray(), 'id' );
        }
        else
        {
            return;
        }

        $existing_menu_ids_matching_with_json = [];

        foreach ( $menus as $menu )
        {
            $result_existing_id = $this->where( 'theme_id', '=', $theme_id )->where( 'slug', '=', $menu->slug )->select( 'id' )->get();

            if ( ! $result_existing_id->isEmpty() )
            {
                $existing_menu_ids_matching_with_json[] = array_column( $result_existing_id->toArray(), 'id' );
            }

        }

        $existing_menu_ids_matching_with_json = array_column( $existing_menu_ids_matching_with_json, 0 );
        $not_existing_menu_ids                = array_diff( $all_menus_from_db, $existing_menu_ids_matching_with_json );

        if ( ! empty( $not_existing_menu_ids ) )
        {
            $this->meta_model->whereIn( 'menu_id', $not_existing_menu_ids )->delete();
        }

        $this->whereIn( 'id', $not_existing_menu_ids )->delete();

    }

}
