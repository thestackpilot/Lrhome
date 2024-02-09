<?php

namespace App\Http\Controllers\Frontend;

class ErrorController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index( $code )
    {
        $this->append_breadcrumbs( $code, '#' );

        $data = [
            'error_code' => $code,
            'heading'    => 'OOPS! NOTHING WAS FOUND',
            'body'       => 'The page you are looking for might have been removed or temprarily unavailable. <a href="'.url( '/' ).'">Return To Homepage</a>'
        ];

        return response()->view( 'frontend.'.$this->active_theme->theme_abrv.'.error', $data );
    }
}
