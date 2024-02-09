<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends AuthController
{
    use RegistersUsers;

    public function __construct()
    {
        parent::__construct();
        $this->middleware( 'guest' );
        $this->model = new User();
    }

    public function register( Request $request )
    {
        try {
            $validator = $this->validator( $request->all() );

            if ( $validator->fails() )
            {
                return redirect()->back()
                    ->withErrors( $validator )
                    ->withInput();
            }

            $requestDataArray             = $request->all();
            $requestDataArray['email']    = $requestDataArray['reg-email'];
            $requestDataArray['password'] = $requestDataArray['reg-password'];
            $data                         = $requestDataArray;
            // remove additional fields
            $fields_to_remove = ['reg-email', 'reg-password', 'interested-in', '_token', 'interested_in', 'cpassword'];

            foreach ( $fields_to_remove as $field )
            {
                unset( $requestDataArray[$field] );
            }

            $data['password']               = Crypt::encryptString( $data['password'] );
            $requestDataArray['password']   = Hash::make( $requestDataArray['password'] );
            $requestDataArray['data']       = serialize( json_encode( $data ) );
            $requestDataArray['created_at'] = date( 'Y-m-d H:i:s' );
            $this->model->add_user( $requestDataArray );

            return redirect()->back()->with( 'message', ['type' => 'success', 'referer' => 'registration', 'body' => 'Thanks for submitting your application. Soon you will receive your UserId on your given email.'] );
        }
        catch ( \Exception$e )
        {
            return redirect()->back()->withInput()->with( 'message', ['type' => 'danger', 'referer' => 'registration', 'body' => env( 'APP_DEBUG', false ) ? $e->getMessage() : 'Something went wrong, please try again later.'] );
        }

    }

    protected function validator( array $data )
    {
        return Validator::make( $data, [
            'reg-email'     => 'required|unique:users,email',
            'reg-password'  => 'required|min:8|max:12',
            'firstname'     => 'required|max:255',
            'lastname'      => 'required|max:255',
            'company'       => 'required|max:255',
            'interested-in' => 'required|max:255',
            'phone'         => 'required|min:12|max:13'
        ], [
            'reg-email.required'    => 'The email field is required.',
            'reg-email.unique'      => 'This email has already been taken.',
            'reg-password.required' => 'The password field is required.',
            'phone.max'             => 'Phone number should be 12 characters only.',
            'phone.min'             => 'Phone number should be 12 characters only.'
        ] );
    }

}
