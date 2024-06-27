<?php

namespace App\Http\Controllers;

use stdClass;
use App\Models\Theme;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

//Application Models

class CommonController
{
    public static $theme_json = null;

    public static function convert_array_to_obj_recursive( $array )
    {
        $obj = new stdClass();

        foreach ( $array as $k => $v )
        {

            if ( strlen( $k ) )
            {

                if ( is_array( $v ) )
                {
                    $obj->{$k}

                    = static::convert_array_to_obj_recursive( $v ); //RECURSION
                }
                else
                {
                    $obj->{$k}

                    = $v;
                }

            }

        }

        return $obj;
    }

    public static function get_selected_columns( $obj, $columns )
    {
        $return = [];
        foreach($columns as $column)
        {
            $found = false;
            foreach($obj as $key => $value)
            {
                if ( strcmp($column, $key) === 0 )
                {
                    $return[$key] = $value;
                    $found = true;
                    break;
                }
            }

            if (!$found) $return[$column] = '-';
        }

        return $return;
    }

    public static function check_bit_field($obj, $key)
    {
        // prr([$key => $obj[$key]]);
        if (isset($obj[$key]))
        {
            if (is_string($obj[$key])) return strtolower($obj[$key]) == 'true';
            else return $obj[$key] == 1 || $obj[$key] == true;
        }
        return  false;
    }

    public static function escape_string( $data, $is_json = 0 )
    {

        if ( is_array( json_decode( $data, 1 ) ) )
        {
            return $data;
        }

        return str_replace( '""', '\""', $data );

        if ( is_array( $data ) ) // this needs to be finalized
        {

            foreach ( $data as $k => $value )
            {
                $data[$k] = self::escape_string( $value );
            }

            return $is_json ? json_encode( $data ) : $data;
        }
        else
        {
            return addslashes( $data );
        }

    }

    public static function generateRandomString( $length = 6 )
    {
        $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen( $characters );
        $randomString     = '';

        for ( $i = 0; $i < $length; $i++ )
        {
            $randomString .= $characters[rand( 0, $charactersLength - 1 )];
        }

        return $randomString;
    }

    //CommonController::getApiFullImage()
    public static function getApiFullImage( $imageName )
    {

        if ( strstr( $imageName, URL::to( '/' ) ) )
        {
            return $imageName;
        }

        if ( self::$theme_json == null )
        {
            self::$theme_json = json_decode(  ( new Theme() )->get_active_theme()->theme_json );
        }

        if ( strstr( $imageName, self::$theme_json->theme_api_image_url ) )
        {
            return $imageName;
        }

        return self::$theme_json->theme_api_image_url.$imageName;
    }

    //CommonController::getApiThumbnailImage()
    public static function getApiThumbnailImage( $imageName )
    {

        if ( self::$theme_json == null )
        {
            self::$theme_json = json_decode(  ( new Theme() )->get_active_theme()->theme_json );
        }

        return self::$theme_json->theme_api_thumbnail_url.$imageName;
    }

    //CommonController::getApiFullImage()
    public static function getImageBasePath( $type = 'full' )
    {

        if ( self::$theme_json == null )
        {
            self::$theme_json = json_decode(  ( new Theme() )->get_active_theme()->theme_json );
        }

        return ( $type == 'full' ) ? self::$theme_json->theme_api_image_url : self::$theme_json->theme_api_thumbnail_url;
    }

    public static function print_menu( $metas, $prefix_li, $li, $postfix_li, $anchor_parent, $prefix_ul, $ul, $postfix_ul, $font_style = 0 )
    {
        $html = '';

        foreach ( $metas as $meta )
        {
            $temp = '';

            if ( isset( $meta->metas ) )
            {
                $temp = $anchor_parent;
            }

            if ( strpos( $meta->meta_url, 'register' ) > 0 && Auth::user() )
            {
                continue;
            }

            $html .= $prefix_li;
            $html .= ' <li '.$li.' > ';
            $html .= ' <a class="'.$temp.'" ';
            $html .= ' href="'.$meta->meta_url.'" >';

// 0 - Normal, 1 - smallcase, 2 - capitalcase, 3 - ucfirst, 3 - ucword
            switch ( $font_style )
            {
                case 1:
                    $html .= strtolower( $meta->meta_title );
                    break;
                case 2:
                    $html .= strtoupper( $meta->meta_title );
                    break;
                case 3:
                    $html .= ucfirst( $meta->meta_title );
                    break;
                case 4:
                    $html .= ucwords( $meta->meta_title );
                    break;
                default:
                    $html .= $meta->menu_meta;
                    break;
            }

            $html .= '</a>';

            if ( isset( $meta->metas ) )
            {
                $html .= $prefix_ul;
                $html .= '<ul '.$ul.' >';
                $html .= static::print_menu( $meta->metas, $prefix_li, $li, $postfix_li, $anchor_parent, $prefix_ul, $ul, $postfix_ul, $font_style );
                $html .= ' </ul> ';
                $html .= $postfix_ul;
            }

            $html .= ' </li> ';
            $html .= $postfix_li;
        }

        return $html;
    }

    public function remove_special_chars( $str )
    {
        $res = str_replace( array( '\'', '"', ',', ';', '<', '>' ), ' ', $str );

        // Returning the result

        return $res;
    }

    //CommonController::upload_file_ftp()
    public static function upload_file_ftp( $file )
    {
        $dest_file = env('STORAGE_PATH', '') . $file->getClientOriginalName();
        $file_storage = env('STORAGE_METHOD', 'ONSITE');
        $source_file = $file->getPathname();

        switch ($file_storage)
        {
            case "FTP":
                $ftp = ftp_connect(env('FTP_HOST'), env('FTP_PORT'));

                if ($ftp)
                {
                    ftp_login($ftp, env('FTP_USER'), env('FTP_PASS'));
                    ftp_set_option($ftp, FTP_USEPASVADDRESS, false);
                    ftp_pasv($ftp, true);
                }

                if (file_exists($source_file))
                {
                    $ret = ftp_put($ftp, $dest_file, $source_file, FTP_BINARY);
                }

                if ($ret)
                {
                    return "http://" . env('FTP_HOST') . "/" . env('FTP_BASE_PATH') . $dest_file;
                }
                ftp_close($ftp);
                break;
            case "ONSITE":
            default:
                return $file->store('storage');
                break;
        }

    }

    //change date format to Month/ Day/ Year. --- CommonController::get_date_format()
    public static function get_date_format( $date )
    {

        if ( self::$theme_json == null )
        {
            self::$theme_json = json_decode(  ( new Theme() )->get_active_theme()->theme_json );
        }

        if ( isset(self::$theme_json->general->date_format) && self::$theme_json->general->date_format )
        {
            $new_date = date(self::$theme_json->general->date_format, strtotime($date));
        }
        else
        {
            $new_date = date("M-d-Y", strtotime($date));
        }

        return $new_date;
    }

}
