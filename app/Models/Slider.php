<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Slider extends Model
{
    use SoftDeletes;
    protected $fillable = ['id','theme_id','name','slug','is_active'];
    private $slider_meta_model;
    public function __construct()
    {
        parent::__construct();
        $this-> slider_meta_model = new SliderMeta();
    }
    public function theme()
    {
        return $this-> belongsTo(Theme::class);
    }
    public function slider_metas()
    {
        return $this-> hasMany(SliderMeta::class);
    }
    // get all sliders for a theme
    public function get_all_sliders($theme_id)
    {
        return $this-> where('theme_id',$theme_id)-> get();
    }
    // save or update sliders and meta
    public function save_or_update_sliders($theme_id, $sliders)
    {
        $this->soft_delete_not_exist_sliders($theme_id, $sliders);
        foreach ($sliders as $slider)
        {
            $result_object = $this->updateOrCreate(
                ['theme_id' => $theme_id, 'name' => $slider->title, 'slug' => $slider->slug],
                ['theme_id' => $theme_id, 'name' => $slider->title, 'slug' => $slider->slug]
            );
        }
    }

    // soft Delete menu that no longer in theme
    private function soft_delete_not_exist_sliders($theme_id,$sliders)
    {
        $get_all_slider_ids = $this->where('theme_id',$theme_id)->select('id')->get();
        if(!$get_all_slider_ids -> isEmpty()){
            $get_all_slider_ids = array_column($get_all_slider_ids-> toArray(),'id');
        }
        else{
            return;
        }
        $existing_slider_ids = [];
        foreach ($sliders as $slider){
            $result = $this-> where('theme_id', '=', $theme_id)-> where('slug','=',$slider->slug)-> first();
            if ($result != null){
                $existing_slider_ids[] = $result->id;
            }
        }
        $ids_to_delete = array_diff($get_all_slider_ids,$existing_slider_ids);
        $this-> slider_meta_model -> whereIn('slider_id',$ids_to_delete)-> delete();
        $this-> whereIn('id',$ids_to_delete)-> delete();

    }
    private function slug_to_outter_key($array)
    {
        $array_with_keys = [];
        foreach ($array as $index)
        {
            $array_with_keys[$index['slug']] = $index;
        }
        return $array_with_keys;
    }
    private function get_slider_meta_for_front($slider)
    {
        $metas = $this->slider_meta_model->where('slider_id',$slider['id'])->get();
        if (!$metas->isEmpty())
        {
            return $metas->toArray();
        }
        else
        {
            return [];
        }
    }
    //-----The cache / session functions
    public function get_sliders_with_meta($theme_id)
    {
        $final_array = [];
        $sliders = $this->where('theme_id',$theme_id)->get();
        if(!$sliders ->isEmpty())
        {
            $final_array = $this->slug_to_outter_key($sliders->toArray());
            foreach ($final_array as $key => $value)
            {
                $value['metas'] = $this->get_slider_meta_for_front($value);
                $final_array[$key] = $value;
            }
        }
        return $final_array;
    }
    public function get_sliders_with_meta_raw()
    {
        return (object)array
        (
            "home_slider" => (object)array
            (
                "slug" => "home_slider",
                "name" => "Home Slider",
                "metas" => (object)array
                (
                    "0" => (object)array
                    (
                        "caption_1"  => "Create your own",
                        "caption_2" => "Unique space",
                        "image" => "http://rizzyhome.ashtexsolutions.com/storage/slider/phpWdSI39.jpg",
                    ),
                    "1" => (object)array
                    (
                        "caption_1"  => "Create your own",
                        "caption_2" => "Unique space",
                        "image" => "http://rizzyhome.ashtexsolutions.com/storage/slider/phpd6aJ4U.jpg",
                    ),
                )

            ),
        );
    }
}
