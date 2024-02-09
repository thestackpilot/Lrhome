<?php

namespace App\Http\Controllers\Frontend;
use App\Models\CatalogsMeta;
use App\Models\Catalogs;

class HomeController extends FrontendController
{
    private $model_catalog_meta;

    public function __construct()
    {
        $this->model_catalog_meta = new CatalogsMeta();
        parent::__construct();
    }

    public function index()
    {
        return view( 'frontend.'.$this->active_theme->theme_abrv.'.home');
    }

    
    public function catalogs()
    {
        $catalog = Catalogs::where('theme_id', $this->active_theme->id)->first();
        $catalog_meta = $this->model_catalog_meta->get_active_catalog_meta($catalog->id);
        return view('frontend.'.$this->active_theme->theme_abrv.'.catalogs',['catalog_meta'=> $catalog_meta,'catalog_id' => $catalog->id]);
    }
}