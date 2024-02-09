<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\Admin\AdminController;

class CacheController extends AdminController
{
    public $pages, $customRoutes;

    private $orders_model;

    public function __construct()
    {
        parent::__construct();
    }

    public function clear_cache( Request $request )
    {

        if ( $request->all() )
        {
            $validated_data = $request->validate( [
                'submit' => 'required',
                'cache'  => 'required'
            ] );

            Redis::select( 1 );

            switch ( $validated_data['cache'] )
            {
                case '-1':
                case -1:

                    foreach ( ConstantsController::CACHEABLE as $type )
                    {
                        $keys = Redis::command( "KEYS", ["*:{$type}:*"] );

                        if ( $keys )
                        {

                            foreach ( $keys as $key )
                            {
                                $key = explode( ':', $key );
                                $key = $key[1].':'.$key[2];
                                Cache::forget( $key );
                            }

                        }

                    }

                    break;
                default:
                    $keys = Redis::command( "KEYS", ["*:{$validated_data['cache']}:*"] );

                    if ( $keys )
                    {

                        foreach ( $keys as $key )
                        {
                            $key = explode( ':', $key );
                            $key = $key[1].':'.$key[2];
                            Cache::forget( $key );
                        }

                    }

                    break;
            }

            return redirect()->route( 'admin.cache-management' )->with( 'message', ['type' => 'success', 'body' => 'Cache clear successfully...'] );
        }

        return redirect()->route( 'admin.cache-management' );

    }

    public function index()
    {
        $cacheable_list = [];
        Redis::select( 1 );

        foreach ( ConstantsController::CACHEABLE as $type )
        {
            $count = count( Redis::command( "KEYS", ["*:{$type}:*"] ) );

            if ( $type == 'theme' )
            {
                $cacheable_list[$type] = 'Selected Theme';
            }
            else
            {
                $cacheable_list[$type] = explode( '_', $type )[1]." Pages ({$count})";
            }

        }

        return view( 'admin.cache', ['cache_types' => $cacheable_list] );
    }

}
