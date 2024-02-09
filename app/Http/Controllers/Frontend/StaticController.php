<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\FrontendController;

class StaticController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display the landing page of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $type )
    {
        $this->append_breadcrumbs( ucfirst( $type ), route( 'static.show', [$type] ) );

        return view( 'frontend.'.$this->active_theme->theme_abrv.'.'.strtolower( $type ) );
    }
}
