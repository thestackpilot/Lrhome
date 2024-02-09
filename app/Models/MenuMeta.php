<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class MenuMeta extends Model
{
    protected $fillable = ['id','menu_id','meta_key','meta_parent_key','meta_image', 'meta_url', 'meta_title'];
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    // update menu metas
    public function update_meta($menu_id, $metas)
    {
        $this->where('menu_id',$menu_id)->delete();
        foreach ($metas as $meta)
        {
            $this -> insert($meta);
        }
    }
}
