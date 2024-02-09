<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\Dashboard\DashboardController;

class StaffController extends DashboardController
{
    public $parent_id = 0;

    public function __construct()
    {
        parent::__construct();
        $this->model     = new User();
        if ( Auth::check() )
        {
            $this->parent_id = Auth::user()->parent_id != 0 ? Auth::user()->parent_id : Auth::user()->id;
        }
    }

    public function create()
    {
        return view( 'dashboard.create-staff', [
            'user'        => '',
            'statuses'    => ConstantsController::USER_STATUSES,
            'permissions' => ConstantsController::PERMISSIONS
        ] );
    }

    public function destroy( $id )
    {
        $this->model->delete_user( $id );

        return redirect()->route( 'dashboard.staff' )->with( 'message', ['type' => 'success', 'body' => 'Record deleted...'] );
    }

    public function fetch( $id )
    {
        $staff_user = $this->model->get_staff_user( $this->parent_id, $id );

        if ( $staff_user )
        {
            return view( 'dashboard.create-staff', [
                'user'        => $staff_user,
                'statuses'    => ConstantsController::USER_STATUSES,
                'permissions' => ConstantsController::PERMISSIONS
            ] );
        }

        return redirect()->route( 'dashboard.staff' )->with( 'message', ['type' => 'danger', 'body' => 'Staff does not exists...'] );
    }

    public function index()
    {
        $staff_users = $this->model->get_staff_user( $this->parent_id );
        $filters     = [
            'fields'     => ['firstname' => 'First Name', 'lastname' => 'Last Name', 'email' => 'Email'],
            'operations' => ConstantsController::ALLOWED_FILTER_OPERATIONS
        ];

        return view( 'dashboard.manage-staff', ['staff_users' => $staff_users, 'filters' => $filters] );
    }

    public function save( Request $request )
    {
        $validated_data = $request->validate( [
            'firstname' => 'required|max:255',
            'lastname'  => 'required|max:255',
            'email'     => 'required|unique:users,email',
            'password'  => 'required|min:8|max:12',
            'cpassword' => 'required|min:8|max:12'
        ] );

        $data = [
            'firstname'           => $validated_data['firstname'],
            'lastname'            => $validated_data['lastname'],
            'email'               => $validated_data['email'],
            'phone'               => isset( $request->phone ) ? $request->phone : '',
            // 'password'            => Hash::make( $validated_data['password'] ),
            'data'                => serialize( json_encode( $request->all() ) ),
            'is_customer'         => Auth::user()->is_customer,
            'is_sale_rep'         => Auth::user()->is_sale_rep,
            'role'                => ConstantsController::USER_ROLES['staff'],
            'parent_id'           => $this->parent_id,
            'customer_id'         => Auth::user()->customer_id,
            'spars_id'            => Auth::user()->spars_id,
            'uuid'                => $this->model->generate_uuid(),
            'sales_rep_customers' => Auth::user()->sales_rep_customers,
            'created_at'          => date( 'Y-m-d H:i:s' )
        ];

        if ( $validated_data['password'] != $validated_data['cpassword'] )
        {
            return redirect()->back()->withInput()->with( 'message', ['type' => 'danger', 'body' => 'New password and confirm password doesn\'t match.'] );
        }

        $data = [
            'password' => Hash::make( $validated_data['password'] )
        ];

        $this->model->add_user( $data );

        return redirect()->route( 'dashboard.staff' )->with( 'message', ['type' => 'success', 'body' => 'Staff user has created successfully...'] );
    }

    public function search( Request $request )
    {
        $staff_users = $this->model->get_staff_user( $this->parent_id, 0, $request->filters );
        $filters     = [
            'fields'     => ['firstname' => 'First Name', 'lastname' => 'Last Name', 'email' => 'Email'],
            'operations' => ConstantsController::ALLOWED_FILTER_OPERATIONS
        ];

        return view( 'dashboard.manage-staff', ['staff_users' => $staff_users, 'filters' => $filters, 'selected_filters' => $request->filters] );
    }

    public function update( $id, Request $request )
    {

        if ( $id !== $request->user )
        {
            return redirect()->route( 'dashboard.staff.fetch', ['id' => $id] )->with( 'message', ['type' => 'danger', 'body' => 'Something went wrong, please try again later...'] );
        }

        $validated_data = $request->validate( [
            'firstname' => 'required|max:255',
            'lastname'  => 'required|max:255',
            'email'     => 'required|unique:users,email,'.$id
        ] );

        $data = [
            'firstname'           => $validated_data['firstname'],
            'lastname'            => $validated_data['lastname'],
            'email'               => $validated_data['email'],
            'phone'               => isset( $request->phone ) ? $request->phone : '',
            'data'                => serialize( json_encode( $request->all() ) ),
            'is_customer'         => Auth::user()->is_customer,
            'is_sale_rep'         => Auth::user()->is_sale_rep,
            'role'                => ConstantsController::USER_ROLES['staff'],
            'parent_id'           => $this->parent_id,
            'customer_id'         => Auth::user()->customer_id,
            'spars_id'            => Auth::user()->spars_id,
            'sales_rep_customers' => Auth::user()->sales_rep_customers,
            'updated_at'          => date( 'Y-m-d H:i:s' )
        ];

        if ( isset( $request->password ) )
        {
            $request->validate( [
                'password'  => 'required|min:8|max:12',
                'cpassword' => 'required|min:8|max:12'
            ] );

            if ( $request->password != $request->cpassword )
            {
                return redirect()->back()->withInput()->with( 'message', ['type' => 'danger', 'body' => 'New password and confirm password doesn\'t match.'] );
            }

            $data['password'] = Hash::make( $request->password );
        }

        $this->model->update_user( $data, $id );

        return redirect()->route( 'dashboard.staff.fetch', ['id' => $id] )->with( 'message', ['type' => 'success', 'body' => 'Record updated...'] );
    }

}
