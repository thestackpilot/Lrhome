<?php
//namespace
namespace App\Http\Controllers\Admin;

//Laravel macros

use View;
use App\Models\Form;

//Application Models
use App\Models\Menu;
use App\Models\Page;

//Base Controllers
use App\Models\Slider;
use App\Models\Showrooms;
use App\Models\Catalogs;
use App\Models\BasicSetting;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApisController;
use App\Http\Controllers\RootController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\ConstantsController;
//Base View
use App\Http\Controllers\Frontend\MainCollectionController;

class AdminController extends RootController
{
    public $ApiObj;

    public $form_model;

    public $main_collections;

    public $menu_model;

    public $model_basic_settings;

    public $page_model;

    public $showroom_model;

    public $slider_model;

    public $catalog_model;

    public function __construct()
    {
        parent::__construct();
        $this->middleware( 'auth' );

        if ( Auth::user() && Auth::user()->role !== ConstantsController::USER_ROLES['admin'] )
        {
            return Redirect::to( 'dashboard' )->send();
            exit();
        }

        $this->page_model           = new Page();
        $this->slider_model         = new Slider();
        $this->showroom_model       = new Showrooms();
        $this->catalog_model        = new Catalogs();
        $this->menu_model           = new Menu();
        $this->form_model           = new Form();
        $this->model_basic_settings = new BasicSetting();
        $this->ApiObj               = new ApisController();

        if ( isset( $this->active_theme->id ) )
        {
            $pages         = $this->page_model->getPageIdName( $this->active_theme->id );
            $sliders       = $this->slider_model->get_all_sliders( $this->active_theme->id );
            $showrooms     = $this->showroom_model->get_all_showrooms( $this->active_theme->id );
            $catalogs      = $this->catalog_model->get_all_catalogs( $this->active_theme->id );
            $menus         = $this->menu_model->get_main_menus( $this->active_theme->id );
            $forms         = $this->form_model->get_main_forms( $this->active_theme->id );
            $basicSettings = $this->model_basic_settings->get_settings( $this->active_theme->id );
           
            View::share( 'basicSettings', $basicSettings );
            View::share( 'menus', $menus );
            View::share( 'forms', $forms );
            View::share( 'pages', $pages );
            View::share( 'sliders', $sliders );
            View::share( 'showrooms', $showrooms );
            View::share( 'catalogs', $catalogs );
        }

        $this->main_collections = ( new MainCollectionController() )->get_main_collections();
        View::share( 'maincollections', $this->main_collections );
    }

}
