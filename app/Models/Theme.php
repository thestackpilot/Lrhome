<?php

namespace App\Models;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Theme extends Model
{
    use SoftDeletes;

    protected $fillable = ['id', 'theme_name', 'theme_slug', 'theme_prefix', 'theme_api_slug', 'theme_abrv', 'theme_api_base_url', 'theme_api_key', 'theme_api_company', 'theme_json'];

    // activate requested one theme and de-activate others
    public function activate_theme( $theme_id )
    {
        $this->where( 'id', $theme_id )->update( ['is_active' => 1] );
        $this->whereNotIn( 'id', [$theme_id] )->update( ['is_active' => 0] );
        session()->forget( 'active_theme' );
        $this->get_active_theme();
    }

    // de-activate requested one theme and de-activate others
    public function de_activate_theme( $theme_id )
    {
        $this->where( 'id', $theme_id )->update( ['is_active' => 0] );
        session()->forget( 'active_theme' );
        $this->get_active_theme();
    }

    public function getAllThemes()
    {
        return $this->all();
    }

    // get active theme
    public function get_active_theme()
    {
        session()->forget( 'active_theme' );

        if ( ! session()->exists( 'active_theme' ) )
        {

            $theme = $this->where( 'is_active', 1 )->select( '*' );

            if ( $theme->count() )
            {
                $active_theme = $theme->first();
            }
            else
            {
                $active_theme = $theme->orWhereRaw( '1=1' )->first();
            }

            /*
            $active_theme = Cache::remember( 'theme', ( 60 * 30 ), function ()
            {
            $theme = $this->where( 'is_active', 1 )->select( '*' );

            if ( $theme->count() )
            {
            $active_theme = $theme->first();
            }
            else
            {
            $active_theme = $theme->orWhereRaw( '1=1' )->first();
            }

            return $active_theme;

            } );
             */

            session( ['active_theme' => $active_theme] );

            return $active_theme;
        }

        return session( 'active_theme' );
    }

    // get Theme directory name
    public function get_theme_directory_name( $theme_ID )
    {
        $directory_name = $this->where( 'id', $theme_ID )->select( 'theme_abrv' )->first();

        return $directory_name->theme_abrv;
    }

    // Save or update themes
    public function save_searched_themes( $themes )
    {
        $this->soft_delete_not_exist_themes( $themes );

        foreach ( $themes as $theme )
        {
            $this->updateOrCreate(
                ['theme_slug' => $theme['theme_slug']],
                [
                    'theme_name'         => $theme['theme_name'],
                    'theme_slug'         => $theme['theme_slug'],
                    'theme_prefix'       => $theme['theme_slug'],
                    'theme_api_slug'     => $theme['theme_api_slug'],
                    'theme_abrv'         => $theme['theme_abrv'],
                    'theme_api_base_url' => env( 'APP_ENV', 'dev' ) === 'dev' ? $theme['theme_api_dev_base_url'] : $theme['theme_api_base_url'],
                    'theme_api_key'      => $theme['theme_api_key'],
                    'theme_api_company'  => $theme['theme_api_company'],
                    'theme_json'         => json_encode( $theme )
                ]
            );
        }

        session()->forget( 'active_theme' );
    }

    // Define relation with sliders
    public function sliders()
    {
        return $this->hasMany( Slider::class );
    }

    // Soft delete those themes that are no longer exist
    private function soft_delete_not_exist_themes( $themes )
    {
        $existing_theme_id = [];

        foreach ( $themes as $theme )
        {
            $result = $this->where( 'theme_slug', '=', $theme['theme_slug'] )->first();

            if ( $result != null )
            {
                $existing_theme_id[] = $result->id;
            }

        }

        $this->whereNotIn( 'id', $existing_theme_id )->delete();

    }

}
