<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApiContentManagement extends Model
{
    use SoftDeletes;

    protected $fillable = ['theme_id', 'hash', 'endpoint', 'request', 'response', 'content'];

    public function create_update_content( $theme_id, $hash, $data )
    {
        $data_to_insert = ['theme_id' => $theme_id, 'hash' => $hash];
        $data_to_insert = array_merge( $data, $data_to_insert );

        $this->updateOrCreate(
            ['theme_id' => $theme_id, 'hash' => $hash],
            $data_to_insert
        );
    }

    public function get_content( $theme_id, $hash, $where = [] )
    {
        return $where ? $this->where( $where )->get() : $this->where( ['theme_id' => $theme_id, 'hash' => $hash] )->first();
    }
}
