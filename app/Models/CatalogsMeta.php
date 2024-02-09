<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatalogsMeta extends Model
{
    use SoftDeletes;
    protected $fillable = ['id','catalog_id','title','caption','image','catalog_pdf','is_active'];

    public function get_catalog_meta($catalog_id)
    {
        return $this->where('catalog_id',$catalog_id)->get();
    }

    public function get_active_catalog_meta($catalog_id)
    {
        return $this->where('catalog_id',$catalog_id)->where('is_active', true)->get();
    }
    // Define Relation with catalogs
    public function catalogs()
    {
        return $this-> belongsTo(catalogs::class);
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
