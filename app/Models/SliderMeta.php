<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SliderMeta extends Model
{
    protected $fillable = ['id','slider_id','caption_1','caption_2','is_active', 'image'];
    // get all sliders from DB
    public function get_slider_meta($slider_id)
    {
        return $this->where('slider_id',$slider_id)->get();
    }
    // Define Relation with slider
    public function slider()
    {
        return $this-> belongsTo(Slider::class);
    }
    ///var/www/public/resosurce/m.jpg
    /// http://localrizzy/resource/m.jpg
    // Get single meta against a meta id
    public function get_single_meta($meta_id)
    {
        return $this->where('id',$meta_id)->first();
    }
    // get old filepath
    public function get_old_file_path($meta_id)
    {
        $file_path = $this->where('id',$meta_id)->select('image')->first();
        return $file_path->image;
    }
    // update Meta
    public function update_meta($meta_id,$data_array)
    {
        $this->where('id',$meta_id)->update($data_array);
    }
}
