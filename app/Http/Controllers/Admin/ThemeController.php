<?php

namespace App\Http\Controllers\Admin;

//Controllers
use Illuminate\Support\Facades\File;
use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\Admin\AdminController;

class ThemeController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    //make a theme active
    public function activate_theme( $theme_id )
    {
        $this->theme_model->activate_theme( $theme_id );
        $this->load_theme();
        //prr($this -> active_theme_json);
        $this->model_basic_settings->create_update_settings( $theme_id );
        $pages = $this->active_theme_json->pages;
        $this->page_model->save_or_update_pages( $theme_id, $pages );
        $menus = $this->active_theme_json->menus;
        $this->menu_model->save_or_update_menus( $theme_id, $menus );
        $slider = $this->active_theme_json->sliders;
        $this->slider_model->save_or_update_sliders( $theme_id, $slider );
        $forms = $this->active_theme_json->forms;
        $this->form_model->save_or_update_forms( $theme_id, $forms );
        $showrooms = $this->active_theme_json->showrooms;
        $this->showroom_model->save_or_update_showrooms( $theme_id, $showrooms );

        return redirect()->route( 'admin.themes' );
    }

    //make a theme de-active
    public function de_activate_theme( $theme_id )
    {
        $this->theme_model->de_activate_theme( $theme_id );
        $this->load_theme();

        return redirect()->route( 'admin.themes' );
    }

    //this will get request
    public function index()
    {

        if ( isset( $_GET['secret'] ) && $_GET['secret'] == md5( ConstantsController::ADMIN_SECRET_STRING ) )
        {
            return view( 'admin.themes', ['themes' => $this->theme_model->getAllThemes()] );
        }

        return redirect()->route( 'admin.basic_settings' );
    }

    //this will be a get request
    public function refresh_themes()
    {
        $directories           = File::directories( base_path( ConstantsController::THEME_BASE_PATH ) );
        $themes_layout_content = [];

        foreach ( $directories as $directory )
        {

            if ( File::exists( $directory.'/theme_layout.json' ) )
            {
                $themes_layout_content[] = json_decode( $content = File::get( $directory.'/theme_layout.json' ), true );
            }

        }

        $this->theme_model->save_searched_themes( $themes_layout_content );

        return redirect()->route( 'admin.themes' );

    }

}
