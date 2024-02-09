<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BasicSetting extends Model
{
    protected $fillable = ['theme_id'];

    public function create_update_settings( $theme_id )
    {
        $this->updateOrCreate(
            ['theme_id' => $theme_id],
            ['theme_id' => $theme_id]
        );
    }

    public function get_all_settings( $theme_id )
    {
        return $this->where( 'theme_id', $theme_id )->first();
    }

    public function get_settings( $theme_id )
    {
        return $this->where( 'theme_id', $theme_id )->first();
    }

    //-----The cache / session functions
    public function get_settings_raw()
    {
        return (object) array(
            "name"       => "Rizzy Home",
            "logo_light" => "https://rizzyhome.botguys.ai/storage/logo/logo.svg",
            "logo_dark"  => "https://rizzyhome.botguys.ai/storage/logo/logo-dark.svg",
            "contact"    => "877 499 7847",
            "email"      => "info@example.com",
            "address"    => "900 Marine Drive Calhoun, GA 30701",
            "website"    => "www.example.com"
        );
    }

    public function update_settings( $id, $settings_array )
    {
        $this->where( 'id', $id )->update( $settings_array );
    }
}
