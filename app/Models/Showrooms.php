<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Showrooms extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['id','theme_id','name','slug','is_active'];
    private $showroom_meta_model;
    public function __construct()
    {
        parent::__construct();
        $this-> showroom_meta_model = new ShowroomsMeta();
    }
    public function theme()
    {
        return $this-> belongsTo(Theme::class);
    }
    public function showrooms_metas()
    {
        return $this-> hasMany(ShowroomsMeta::class);
    }
    // get all showrooms for a themeget_showrooms_with_meta
    public function get_all_showrooms($theme_id)
    {
        return $this-> where('theme_id',$theme_id)-> get();
    }
    // save or update showrooms and meta
    public function save_or_update_showrooms($theme_id, $showrooms)
    {
        $this->soft_delete_not_exist_showrooms($theme_id, $showrooms);
        foreach ($showrooms as $showroom)
        {
            $result_object = $this->updateOrCreate(
                ['theme_id' => $theme_id, 'name' => $showroom->title, 'slug' => $showroom->slug],
                ['theme_id' => $theme_id, 'name' => $showroom->title, 'slug' => $showroom->slug]
            );
        }
    }

    // soft Delete menu that no longer in theme
    private function soft_delete_not_exist_showrooms($theme_id,$showrooms)
    {
        $get_all_showroom_ids = $this->where('theme_id',$theme_id)->select('id')->get();
        if(!$get_all_showroom_ids -> isEmpty()){
            $get_all_showroom_ids = array_column($get_all_showroom_ids-> toArray(),'id');
        }
        else{
            return;
        }
        $existing_showroom_ids = [];
        foreach ($showrooms as $showroom){
            $result = $this-> where('theme_id', '=', $theme_id)-> where('slug','=',$showroom->slug)-> first();
            if ($result != null){
                $existing_showroom_ids[] = $result->id;
            }
        }
        $ids_to_delete = array_diff($get_all_showroom_ids,$existing_showroom_ids);
        $this-> showroom_meta_model -> whereIn('showroom_id',$ids_to_delete)-> delete();
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
    private function get_showroom_meta_for_front($showroom)
    {
        $metas = $this->showroom_meta_model->where('showroom_id',$showroom['id'])->get();
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
    public function get_showrooms_with_meta($theme_id)
    {
        $final_array = [];
        $showrooms = $this->where('theme_id',$theme_id)->get();
        if(!$showrooms ->isEmpty())
        {
            $final_array = $this->slug_to_outter_key($showrooms->toArray());
            foreach ($final_array as $key => $value)
            {
                $value['metas'] = $this->get_showroom_meta_for_front($value);
                $final_array[$key] = $value;
            }
        }
        return $final_array;
    }
    public function get_showrooms_with_meta_raw()
    {
        return (object)array
        (
            "rzy_showrooms" => (object)array
            (
                "slug" => "rzy_showrooms",
                "name" => "Rizzy Showrooms",
                "metas" => (object)array
                (
                    "0" => (object)array
                    (
                        "title"  => "High Point Market Showplace 3515",
                        "area" => "High Point, NC",
                        "address" => "211 E Commerce Ave High Point, NC 27260",
                        "image" => "",
                    ),
                    "1" => (object)array
                    (
                        "title"  => "World Market Center Building B, B355",
                        "area" => "Las Vegas, NV",
                        "address" => "495 S Grand Central Pkwy Las Vegas, NV 89106",
                        "image" => "",
                    ),
                )

            ),
        );
    }
}
