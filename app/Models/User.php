<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function add_user( $data )
    {
        return $this->insert( $data );
    }

    public function delete_user( $id )
    {
        return $this->where( 'id', $id )->delete();
    }

    public function generate_uuid()
    {
        $number = mt_rand( 10000000, 99999999 );

        if ( $this->uuid_exists( $number ) )
        {
            return $this->generate_uuid();
        }

        return $number;
    }

    public function getDataAttribute( $attribute, $default = '-' )
    {
        return isset( $this->parseDataAttribute()->{$attribute} ) ? $this->parseDataAttribute()->{$attribute}

            : $default;
    }

    public function getPermissions()
    {
        return $this->getDataAttribute( 'permissions', [] );
    }

    public function get_staff_user( $parent_id, $staff_id = 0, $filters = [] )
    {
        $where = ['parent_id' => $parent_id];

        if ( $staff_id )
        {
            $where['id'] = $staff_id;
        }

        if ( $filters )
        {
            $query = $this->where( $where )->where( function ( $query ) use ( $filters, $where )
            {

                foreach ( $filters as $key => $filter )
                {

                    if ( $filter['value'] )
                    {
                        $query->orWhere( $key, $filter['operation'], $filter['operation'] == '=' ? "{$filter['value']}" : "%{$filter['value']}%" );
                    }

                }

            } );
        }
        else
        {
            $query = $this->where( $where );
        }

        return $staff_id ? $query->first() : $query->get();
    }

    public function get_user( $colum, $value, $where = '' )
    {

        if ( is_array( $where ) && $where )
        {
            return $this->where(
                function ( $query ) use ( $where )
                {

                    foreach ( $where as $col => $val )
                    {

                        if ( is_null( $val ) )
                        {
                            $query->whereNull( $col );
                        }
                        else
                        {
                            $query->where( $col, $val );
                        }

                    }

                } )->first();
        }
        else
        {
            return $this->where( $colum, $value )->first();
        }

    }

    public function parseDataAttribute()
    {
        return json_decode( unserialize( $this->attributes['data'] ) );
    }

    public function update_user( $data, $id )
    {
        return $this->where( 'id', $id )->update( $data );
    }

    public function uuid_exists( $number )
    {
        return $this->where( 'uuid', $number )->exists();
    }

    // protected function email(): Attribute
    // {
    //     return Attribute::make(
    //         get:fn( $value ) => join( '', [explode( '@', $value )[1], explode( '+', $value )[0]] ),
    //     );
    // }

}
