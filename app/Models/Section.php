<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Page;
use App\Models\SectionMeta;

class Section extends Model
{
    use SoftDeletes;
    protected $fillable = ['id','name','slug','page_id','is_active'];
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function sectionmeta()
    {
        return $this->hasMany(sectionMeta::class);
    }

    public function update_active_status($section_id,$section_is_active)
    {
        $this->where('id',$section_id)->update(['is_active' => $section_is_active]);
    }
}
