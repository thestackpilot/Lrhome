<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Catalogs extends Model
{
    use SoftDeletes;
    protected $fillable = ['id','theme_id','name','slug','is_active'];

    private $catalog_meta_model;
    public function __construct()
    {
        parent::__construct();
        $this-> catalog_meta_model = new CatalogsMeta();
    }
    public function theme()
    {
        return $this-> belongsTo(Theme::class);
    }
    public function catalogs_metas()
    {
        return $this-> hasMany(CatalogsMeta::class);
    }
    // get all catalogs for a themeget_catalogs_with_meta
    public function get_all_catalogs($theme_id)
    {
        return $this-> where('theme_id',$theme_id)-> get();
    }
    // save or update catalogs and meta
    public function save_or_update_catalogs($theme_id, $catalogs)
    {
        $this->soft_delete_not_exist_catalogs($theme_id, $catalogs);
        foreach ($catalogs as $catalog)
        {
            $result_object = $this->updateOrCreate(
                ['theme_id' => $theme_id, 'name' => $catalog->title, 'slug' => $catalog->slug],
                ['theme_id' => $theme_id, 'name' => $catalog->title, 'slug' => $catalog->slug]
            );
        }
    }

    // soft Delete menu that no longer in theme
    private function soft_delete_not_exist_catalogs($theme_id,$catalogs)
    {
        $get_all_catalog_ids = $this->where('theme_id',$theme_id)->select('id')->get();
        if(!$get_all_catalog_ids -> isEmpty()){
            $get_all_catalog_ids = array_column($get_all_catalog_ids-> toArray(),'id');
        }
        else{
            return;
        }
        $existing_catalog_ids = [];
        foreach ($catalogs as $catalog){
            $result = $this-> where('theme_id', '=', $theme_id)-> where('slug','=',$catalog->slug)-> first();
            if ($result != null){
                $existing_catalog_ids[] = $result->id;
            }
        }
        $ids_to_delete = array_diff($get_all_catalog_ids,$existing_catalog_ids);
        $this-> catalog_meta_model -> whereIn('catalog_id',$ids_to_delete)-> delete();
        $this-> whereIn('id',$ids_to_delete)-> delete();

    }
}
