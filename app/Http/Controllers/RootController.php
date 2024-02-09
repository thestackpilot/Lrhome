<?php

namespace App\Http\Controllers;

//Laravel macros
use View;
use App\Models\Theme;
use Illuminate\Foundation\Bus\DispatchesJobs;
//Base Controllers
use Illuminate\Routing\Controller as BaseController;

//Application Models
use Illuminate\Foundation\Validation\ValidatesRequests;

//Base View
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RootController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $active_theme;

    public $active_theme_json;

    public $theme_model;

    public function __construct()
    {
        $this->theme_model = new Theme();
        $this->load_theme();
    }

    public function load_theme()
    {
        $this->active_theme = $this->theme_model->get_active_theme();
        View::share( 'active_theme', $this->active_theme );

        if ( isset( $this->active_theme->theme_json ) )
        {
            $this->active_theme_json = json_decode( $this->active_theme->theme_json );
            View::share( 'active_theme_json', $this->active_theme_json );
        }

    }

}
