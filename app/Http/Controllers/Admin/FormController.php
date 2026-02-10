<?php

namespace App\Http\Controllers\Admin;

use App\Models\Form;
use App\Models\FormMeta;
use App\Models\FormEntries;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\AdminController;

class FormController extends AdminController
{
    private $form_meta;

    public function __construct()
    {
        parent::__construct();
        // $this->form_meta = new FormMeta();
    }

    public function create_menu_meta_array( $menu_id, $keys, $titles, $urls, $parents, $images )
    {
        $final_meta_array = [];
        $i                = 0;
        $meta_array       = [];

        foreach ( $titles as $title )
        {
            $meta_array['menu_id']         = $menu_id;
            $meta_array['meta_key']        = $keys[$i];
            $meta_array['meta_title']      = $title;
            $meta_array['meta_url']        = $urls[$i];
            $meta_array['meta_parent_key'] = $parents[$i];
            $meta_array['meta_image']      = $images[$i];
            array_push( $final_meta_array, $meta_array );
            $i++;
        }

        return $final_meta_array;
    }

    public function index( $form_id )
    {
        $form_metas_with_parent = $this->form_model->get_form_with_meta( $form_id );

        return view( 'admin.form', ['form' => $form_metas_with_parent] );
    }

    public function show_submissions( Request $request, $slug )
    {

        if ( $request->has( 'draw' ) && $request->draw )
        {
            $page      = $request->start == 0 ? 0 : ( $request->start / $request->length );
            $page_size = $request->length;
        }
        else
        {
            $page      = 0;
            $page_size = 25;
        }

        $form = Form::where( 'slug', $slug )->firstOrFail();
        // $form_entries = FormEntries::where( 'form_id', $form->id )->limit( $page, $page_size )->get();
        $form_entries = FormEntries::where( 'form_id', $form->id )
            ->orderBy( 'created_at', 'DESC' )
            ->paginate( 50 );

        $table = array( 'thead' => [], 'tbody' => [] );

        foreach ( $form_entries as $k => $form_entry )
        {

            if ( $k < 1 )
            {
                $table['thead'] = array_keys( json_decode( $form_entry->data, 1 ) );
            }

            $table['tbody'][$k] = json_decode( $form_entry->data, 1 );

            if ( key_exists( 'attachment', $table['tbody'][$k] ) )
            {
                //$table['tbody'][$k]['attachment'] = '<a href="'.asset( $table['tbody'][$k]['attachment'] ).'" target="_blank">'.asset( $table['tbody'][$k]['attachment'] ).'</a>';
                $attachment = $table['tbody'][$k]['attachment'];

                if ( is_array( $attachment ) )
                {
                    $links = [];
                    foreach ( $attachment as $att )
                    {
                        if ( is_string( $att ) && strlen( $att ) )
                        {
                            $url      = asset( $att );
                            $links[]  = '<a href="'.$url.'" target="_blank">'.$url.'</a>';
                        }
                    }
                    $table['tbody'][$k]['attachment'] = implode( ', ', $links );
                }
                elseif ( is_string( $attachment ) && strlen( $attachment ) )
                {
                    $url = asset( $attachment );
                    $table['tbody'][$k]['attachment'] = '<a href="'.$url.'" target="_blank">'.$url.'</a>';
                }
                else
                {
                    $table['tbody'][$k]['attachment'] = '';
                }
            }

        }

        foreach ( $table['thead'] as $k => $heading )
        {

            if ( $heading == '_token' || $heading == 'form' )
            {
                unset( $table['thead'][$k] );
            }

        }

        return view( 'admin.forms-data', ['table' => $table, 'title' => $form->name, 'form_entries' => $form_entries] );
    }

    public function update( Request $request, $menu_id )
    {
        $this->menu_model->update_is_active( $menu_id, $request->is_active );
        $meta_array = $this->create_menu_meta_array( $menu_id, $request->key, $request->title, $request->url, $request->parent, $request->image );
        $this->menu_meta_model->update_meta( $menu_id, $meta_array );

        return redirect()->route( 'admin.menu', ['menu_id' => $menu_id] );
    }

}
