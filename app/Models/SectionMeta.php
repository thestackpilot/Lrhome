<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Section;

class SectionMeta extends Model
{
    protected $fillable = ['id','section_id','meta_key','meta_value'];
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function update_section_meta($section_id,$meta_array)
    {
        foreach ($meta_array as $meta_key => $meta_value)
        {
            $this->updateOrCreate(
                ['section_id' => $section_id, 'meta_key' => $meta_key],
                ['section_id' => $section_id, 'meta_key' => $meta_key,'meta_value' => $meta_value]
            );
        }

        // foreach ($meta_array as $meta_key => $meta_value)
        // {
            
        //     $this -> where ( 'section_id' , $section_id ) -> where ( 'meta_key' , $meta_key ) -> update ( [ 'meta_value' => $meta_value ]);

        // }
    }
}
