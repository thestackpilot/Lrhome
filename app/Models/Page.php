<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Section;
use App\Models\SectionMeta;


class Page extends Model
{
    use SoftDeletes;
    private $model_sections, $model_section_meta;
    protected $fillable = ['id','theme_id','name','slug','is_active'];
    public function __construct()
    {
        parent::__construct();
        $this-> model_sections = new Section();
        $this-> model_section_meta = new SectionMeta();
    }

    public function getPageIdName($theme_id)
    {
        return $this->select('id', 'name')->where('theme_id',$theme_id)->get();
    }

    public function getPages($theme_id)
    {
        return $this->select('*')->where('theme_id',$theme_id)->get();
    }

    public function getSinglePage($page_id)
    {
        return $this->select('*')->where('id',$page_id)->first();
    }

    public function getSinglePageSections($page_id)
    {
        return  $this->model_sections->where('page_id',$page_id)->with('sectionmeta')->get();

    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
    // save or update pages
    public function save_or_update_pages($theme_id, $pages)
    {
        $this->soft_delete_not_exist_pages($theme_id, $pages);
        foreach ($pages as $page)
        {
            $result_object = $this->updateOrCreate(
                ['theme_id' => $theme_id, 'slug' => $page->slug],
                ['theme_id' => $theme_id,  'slug' => $page->slug, 'name' => $page->title]
            );
            $this-> save_new_sections($result_object-> id, $page->sections);
        }
    }

    // save new section of a page
    private function save_new_sections($page_id, $sections)
    {
        $this->soft_delete_not_exist_sections($page_id, $sections);
        foreach ($sections as $section)
        {

            $result_obj = $this-> model_sections-> updateOrCreate(
                ['page_id' => $page_id, 'slug' => $section->slug],
                ['page_id' => $page_id, 'slug' => $section->slug, 'name' => $section->title]
            );
            $this-> save_section_meta($result_obj-> id,$section->metas);
        }
    }

    // save or update section meta
    private function save_section_meta($section_id, $section_meta)
    {
        foreach ($section_meta as $meta_key => $meta_type)
        {
            $this-> model_section_meta-> updateOrCreate(
                ['section_id' => $section_id, 'meta_key' => $meta_key],
                ['section_id' => $section_id, 'meta_key' => $meta_key]
            );
        }
    }

    // soft Delete Sections
    private function soft_delete_not_exist_sections($page_id, $sections)
    {
        $get_all_section_ids = $this-> model_sections-> where('page_id',$page_id)->select('id')->get();
        if (!$get_all_section_ids -> isEmpty()){
            $get_all_section_ids = array_column($get_all_section_ids->toArray(),'id');
        }
        else{
            return;
        }
        $existing_section_ids = [];
        foreach ($sections as $section){
            $result = $this-> model_sections -> where('page_id', '=', $page_id)-> where('slug','=',$section->slug)-> first();
            if ($result != null){
                $existing_section_ids[] = $result->id;
            }
        }
        $ids_to_delete = array_diff($get_all_section_ids, $existing_section_ids);
        if (empty($ids_to_delete)){
            return;
        }
        prr($ids_to_delete);
        $this-> model_section_meta-> whereIn('section_id',$ids_to_delete)-> delete();
        $this-> model_sections-> whereIn('id',$ids_to_delete)-> delete();


    }

    // soft Delete pages that are no longer exist
    private function soft_delete_not_exist_pages($theme_id, $pages)
    {
        $existing_page_ids = [];
        $all_pages_ids = $this->where('theme_id',$theme_id)->select('id')->get();
        if(!$all_pages_ids ->isEmpty()){
            $all_pages_ids = array_column($all_pages_ids->toArray(),'id');
        }
        else
        {
            return;
        }
        foreach ($pages as $page){
            $result = $this-> where('theme_id', $theme_id)-> where('slug',$page->slug)-> first();
            if ($result != null){
                $existing_page_ids[] = $result->id;
            }
        }
        $ids_to_delete = array_diff($all_pages_ids,$all_pages_ids);
        if(empty($ids_to_delete)){
            return;
        }
        $this-> whereIn('id',$ids_to_delete)-> delete();
        $section_ids_to_delete = $this-> model_sections -> whereIn('page_id',$existing_page_ids)->select('id')->get();
        $this-> model_sections -> whereIn('page_id',$existing_page_ids)-> delete();
        if (!$section_ids_to_delete ->isEmpty()){
            foreach ($section_ids_to_delete as $section_id)
            {
                $this-> model_section_meta-> where('section_id',$section_id->id)-> delete();
            }
        }


    }
    //-----The cache / session functions
    private function array_slug_to_outter_key($array)
    {
        $array_with_keys = [];
        foreach ($array as $index)
        {
            $array_with_keys[$index['slug']] = $index;
        }
        return $array_with_keys;
    }
    private function get_sections_with_meta($page)
    {
        $array_to_return = [];
        $sections = $this->model_sections ->where('page_id',$page['id'])->get();
        if(!$sections ->isEmpty()){
            $sections = $sections->toArray();
        }

        foreach ($sections as $section){
            $section_metas_array = [];
            $section_meta = $this->model_section_meta->where('section_id',$section['id'])->get();
            foreach($section_meta as $meta)
            {
                $section_metas_array [$meta -> meta_key] = $meta -> meta_value;
            }
            $section['title'] = $section['name'];
            $section = array_merge($section,$section_metas_array);
            array_push($array_to_return,$section);
        }
        return $this->array_slug_to_outter_key($array_to_return);

    }
    public function get_pages_with_sections($theme_id)
    {
        $final_array = [];
        $pages = $this->where('theme_id',$theme_id)->get();
        if(!$pages->isEmpty())
        {
            $final_array = $this->array_slug_to_outter_key($pages->toArray());
            foreach ($final_array as $key => $value)
            {
                $value['sections'] = $this->get_sections_with_meta($value);
                $final_array[$key] = $value;
            }
        }
        return $final_array;
    }
    public function get_pages_with_sections_raw()
    {
        return (object)array
        (
            "home" => (object)array
            (
                "slug" => "home",
                "name" => "Home",
                "sections" => (object)array
                (
                    "new_arrival" => (object)array
                    (
                        "title" => "Explore New Arrivals",

                        "image_1_title" => "See What's new",
                        "image_1_caption" => "1999",
                        "image_1_image" => "https://rizzyhome.ashtexsolutions.com/storage/home/1/image_left.jpg",
                        "image_1_url" => "#",

                        "image_2_title" => "Bestsellers",
                        "image_2_caption" => "2000",
                        "image_2_image" => "https://rizzyhome.ashtexsolutions.com/storage/home/1/image_top_left.jpg",
                        "image_2_url" => "url",

                        "image_3_title" => "The Nala Collection",
                        "image_3_caption" => "2019",
                        "image_3_image" => "https://rizzyhome.ashtexsolutions.com/storage/home/1/image_top_right.jpg",
                        "image_3_url" => "url",

                        "image_4_title" => "The Rayan Collection",
                        "image_4_caption" => "2021",
                        "image_4_image" => "https://rizzyhome.ashtexsolutions.com/storage/home/1/image_bottom.jpg",
                        "image_4_url" => "url"
                    ),
                    "new_additions" => (object)array
                    (
                        "title" => "Let's get Rizzy",
                        "caption" => "Follow our blog for the latest trends, home tips, and touching stories from Textile Talker, Teresa",
                        "button_title" => "FIND OUT MORE",
                        "button_url" => "https://rizzyhome.ashtexsolutions.com/about-us",
                        "image" => "#"
                    ),
                    "our_products" => (object)array
                    (
                        "title" => "Our Products",
                        "caption" => "",

                        "prod_1_title" => "Rugs",
                        "prod_1_caption" => "",
                        "prod_1_image" => "https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-1.jpg",
                        "prod_1_url" => "https://rizzyhome.ashtexsolutions.com/category/1",

                        "prod_2_title" => "Bedding",
                        "prod_2_caption" => "",
                        "prod_2_image" => "https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-2.jpg",
                        "prod_2_url" => "https://rizzyhome.ashtexsolutions.com/category/2",

                        "prod_3_title" => "Pillow",
                        "prod_3_caption" => "",
                        "prod_3_image" => "https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-3.jpg",
                        "prod_3_url" => "https://rizzyhome.ashtexsolutions.com/category/3",

                        "prod_4_title" => "Rugs",
                        "prod_4_caption" => "",
                        "prod_4_image" => "https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-4.jpg",
                        "prod_4_url" => "https://rizzyhome.ashtexsolutions.com/category/1"
                    ),
                    "learn_more" => (object)array
                    (
                        "title" => "",
                        "caption" => "We make rugs for the thoughtfully layered home. For spaces designed with intention. For people that know a good rug doesn’t just tie the room together—it sets the home apart.",
                        "button_text" => "Learn More",
                        "button_url" => "https://rizzyhome.ashtexsolutions.com/about-us"
                    ),
                    "about_rizzy" => (object)array
                    (
                        "title_top" => "About",
                        "title_bottom" => "Rizzy Home",
                        "description" => "The direct result of collaboration between two entrepreneurial brothers, Rizzy Home is the combined effort of Rizwan and Shamsu Ansari. Originally started as Rizzy Rugs and Home Texco, Rizzy Home now offers an extensive assortment of rugs.",
                        "video" => "https://www.youtube.com/embed/dgWzTvRhBkU"
                    ),
                )

            ),
        );
    }
    public function get_pages_with_sections_raw_lr()
    {
        return (object)array
        (
            "home" => (object)array
            (
                "slug" => "home",
                "title" => "home",
                "sections" => (object)array
                (
                    "banner" => (object)array
                    (
                        "banner_title" => "L R HOME",
                        "banner_caption" => "View All New Collections",
                        "caption_url" => "#"
                    ),
                    "categories" => (object)array
                    (
                        "title" => "New Arrivals",

                        "image_1_title" => "See What's new",
                        "image_1_caption" => "1999",
                        "image_1_image" => "LR/images/product/1.jpg",
                        "image_1_url" => "#",

                        "image_2_title" => "Bestsellers",
                        "image_2_caption" => "2000",
                        "image_2_image" => "LR/images/product/2.jpg",
                        "image_2_url" => "url",

                        "image_3_title" => "The Nala Collection",
                        "image_3_caption" => "2019",
                        "image_3_image" => "LR/images/product/3.jpg",
                        "image_3_url" => "url",

                        "image_4_title" => "The Rayan Collection",
                        "image_4_caption" => "2021",
                        "image_4_image" => "LR/images/product/4.jpg",
                        "image_4_url" => "url",

                        "image_5_title" => "The Rayan Collection",
                        "image_5_caption" => "2021",
                        "image_5_image" => "LR/images/product/5.jpg",
                        "image_5_url" => "url",


                        "image_6_title" => "The Rayan Collection",
                        "image_6_caption" => "2021",
                        "image_6_image" => "LR/images/product/6.jpg",
                        "image_6_url" => "url"
                    ),
                    "new_arrivals" => (object)array
                    (
                        "title_1" => "Rugs",
                        "caption_1" => "Fusing transitional elegance with modern influence, our rug selection boasts artisanal quality gems at accessible price points",
                        "button_title_1" => "Shop Now",
                        "button_url_1" => "#",
                        "featured_image_1" => "LR/images/featured-product/df-1.png",
                        "featured_image_url_1" => "#",



                        "title_2" => "Pillows",
                        "caption_2" => "Enjoy our curated collection of throw pillows - Our wide selection is handcrafted in India and loved worldwide",
                        "button_title_2" => "Shop Now",
                        "button_url_2" => "#",
                        "featured_image_2" => "LR/images/featured-product/df-2.png",
                        "featured_image_url_2" => "#",


                        "title_3" => "Furniture",
                        "caption_3" => "Our newly launched furniture selection is a passion project centered around providing the most comprehensive catalog to our customers - Check it out and let us know what you think!",
                        "button_title_3" => "Shop Now",
                        "button_url_3" => "#",
                        "featured_image_3" => "LR/images/featured-product/df-3.png",
                        "featured_image_url_3" => "#"

                    ),
                    "catalog" => (object)array
                    (

                        "catalog_title_1" => "See What's New This Season",
                        "catalog_title_2" => "Catalog 2021",
                        "catalog_image" => "https://rizzyhome-images.ashtexsolutions.com/RizzyHome_B2BImages/Images/Full_Img/home-image-1.jpg",
                        "catalog_button_title" => "Browse E-catalog",
                        "catalog_button_url" => "#",


                    ),
                    "partnerhip" => (object)array
                    (
                        "title" => "apply to become a LR HOME partner",
                        "button_text" => "Apply Now",
                        "button_url" => "#"
                    ),

                )

            ),
        );
    }
}
