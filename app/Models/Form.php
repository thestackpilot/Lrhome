<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use SoftDeletes;

    protected $fillable = ['theme_id', 'name', 'slug', 'metas'];

    private $meta_model;

    public function __construct()
    {
        // $this->meta_model = new FormMeta();
    }

    public function form_metas()
    {
        return $this->hasMany( FormMeta::class );
    }

    public function get_form_with_meta( $form_id )
    {
        return $this->where( 'id', $form_id )->with( 'form_metas' )->first(); //use dynamic bindings

    }

    // get main forms
    public function get_main_forms( $theme_id )
    {
        return $this->where( 'theme_id', $theme_id )->get();
    }

    // save or update forms and meta
    public function save_or_update_forms( $theme_id, $forms )
    {
        $this->soft_delete_not_exist_forms( $theme_id, $forms );

        foreach ( $forms as $form )
        {
            $result_obj = $this->updateOrCreate(
                ['theme_id' => $theme_id, 'slug' => $form->slug],
                ['theme_id' => $theme_id, 'name' => $form->title, 'slug' => $form->slug, 'metas' => serialize( (array) $form->metas )]
            );
        }

    }

    public function update_is_active( $form_id, $is_active )
    {
        $this->where( 'id', $form_id )->update( ['is_active' => $is_active] );
    }

    // soft Delete menu that no longer in theme
    private function soft_delete_not_exist_forms( $theme_id, $forms )
    {
        $not_existing_form_ids = [];
        $all_forms_from_db     = $this->where( 'theme_id', $theme_id )->select( 'id' )->get();

        if ( ! $all_forms_from_db->isEmpty() )
        {
            $all_forms_from_db = array_column( $all_forms_from_db->toArray(), 'id' );
        }
        else
        {
            return;
        }

        $existing_form_ids_matching_with_json = [];

        foreach ( $forms as $form )
        {
            $result_existing_id = $this->where( 'theme_id', '=', $theme_id )->where( 'slug', '=', $form->slug )->select( 'id' )->get();

            if ( ! $result_existing_id->isEmpty() )
            {
                $existing_form_ids_matching_with_json[] = array_column( $result_existing_id->toArray(), 'id' );
            }

        }

        $existing_form_ids_matching_with_json = array_column( $existing_form_ids_matching_with_json, 0 );
        $not_existing_form_ids                = array_diff( $all_forms_from_db, $existing_form_ids_matching_with_json );

        if ( ! empty( $not_existing_form_ids ) )
        {
            $this->meta_model->whereIn( 'form_id', $not_existing_form_ids )->delete();
        }

        $this->whereIn( 'id', $not_existing_form_ids )->delete();

    }

}
