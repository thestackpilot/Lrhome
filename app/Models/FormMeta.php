<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class FormMeta extends Model
{
    protected $fillable = ['id','form_id'];
    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    // update menu metas
    public function update_meta($form_id, $metas)
    {
        $this->where('form_id',$form_id)->delete();
        foreach ($metas as $meta)
        {
            $this -> insert($meta);
        }
    }
}
