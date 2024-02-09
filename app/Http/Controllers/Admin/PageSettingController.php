<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\SectionMeta;
use Illuminate\Http\Request;

//use App\Models\Category;
use App\Models\Page;
use App\Models\Section;
//use App\Models\SectionMeta;
use App\Models\Theme;

class PageSettingController extends AdminController
{
    public $model_section;
    public $model_section_meta;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this -> model_section = new Section();
        $this -> model_section_meta = new SectionMeta();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $sections = $this -> page_model -> getSinglePageSections($id);
        $active_page = $this -> page_model -> getSinglePage($id);

        //getting the saved metas from the DB
        $sections_meta = array();
        foreach($sections as $section)
        {
            if(!isset($sections_meta[$section -> id]))
            {
                $sections_meta[$section -> id] = array();
            }
            $metas = $section -> sectionmeta;
            foreach($metas as $meta)
            {
                $sections_meta[$section -> id][$meta -> meta_key] = $meta -> meta_value;
            }
        }
        $data = array
        (
            'active_page' => $active_page,
            'sections' => $sections,
            'sections_meta' => $sections_meta,
            'active_theme' => $this -> active_theme_json
        );
        return view('admin.page-settings', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'meta'                      =>      'array|min:1',
            'meta.image'                =>      'image|mimes:jpeg,png,jpg,svg',
            'meta.image_1_image'        =>      'image|mimes:jpeg,png,jpg,svg',
            'meta.image_2_image'        =>      'image|mimes:jpeg,png,jpg,svg',
            'meta.image_3_image'        =>      'image|mimes:jpeg,png,jpg,svg',
            'meta.image_4_image'        =>      'image|mimes:jpeg,png,jpg,svg',
            'meta.image_5_image'        =>      'image|mimes:jpeg,png,jpg,svg',
            'meta.image_6_image'        =>      'image|mimes:jpeg,png,jpg,svg',
            'meta.catalog_img'          =>      'image|mimes:jpeg,png,jpg,svg',
            'meta.about_us_image_1'     =>      'image|mimes:jpeg,png,jpg,svg',
            'meta.about_us_image_2'     =>      'image|mimes:jpeg,png,jpg,svg',
            'meta.about_us_image_3'     =>      'image|mimes:jpeg,png,jpg,svg',
        ]);

        $section_id         =   $request ->  section_id;
        $section_is_active  =   $request ->  is_active;
        $section_meta       =   $request ->  meta;


        foreach( $section_meta as $key => $value ) 
        {
            if ( isset($value) && is_file( $value ) )
            {
                $section_meta[$key] = CommonController::upload_file_ftp($value);
            }
        }

        $this-> model_section -> update_active_status($section_id,$section_is_active);
        $this -> model_section_meta -> update_section_meta($section_id,$section_meta);
        return redirect()->route('admin.page_setting',['id' => $id]);
    
        // $section_id = $request->section_id;
        // $section_is_active = $request->is_active;
        // $section_meta = $request-> meta;
        // $this-> model_section -> update_active_status($section_id,$section_is_active);
        // $this -> model_section_meta -> update_section_meta($section_id,$section_meta);
        // return redirect()->route('admin.page_setting',['id' => $id]);
    }

}
