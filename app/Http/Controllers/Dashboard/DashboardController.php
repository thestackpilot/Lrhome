<?php
namespace App\Http\Controllers\Dashboard;

//Laravel macros
//Application Models
use View;
//Base Controllers
use App\Models\Cart;
use App\Models\Menu;
use App\Models\Page;
//Base View
use App\Models\BasicSetting;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApisController;
use App\Http\Controllers\RootController;
use App\Http\Controllers\CommonController;

class DashboardController extends RootController
{
    public $ApiObj;

    public $basicSettings;

    public $page_model;

    protected $pages;

    public function __construct()
    {
        parent::__construct();
        $this->middleware( 'auth' );

        $this->ApiObj = new ApisController();

        $this->basicSettings = ( new BasicSetting() )->get_settings( $this->active_theme->id );

        $this->pages = CommonController::convert_array_to_obj_recursive(  ( new Page() )->get_pages_with_sections( $this->active_theme->id ) );

        $sidebar = json_decode( $this->active_theme->theme_json, 1 );
        View::share( 'sidebar', $sidebar['sidebar'] );

        $this->middleware( 'dashboardPermissions:'.serialize( $sidebar['sidebar'] ) );

        View::share( 'pages', $this->pages );

        View::share( 'basicSettings', $this->basicSettings );

        View::share( 'menus', CommonController::convert_array_to_obj_recursive(  ( new Menu() )->get_menus_with_meta( $this->active_theme->id ) ) );

        View::share( 'cart', CommonController::convert_array_to_obj_recursive(  ( new Cart() )->get_cart_for_front( $this->ApiObj ) ) );

    }

    // array('ItemID' => $item_id, 'SaleInvoiceNo' => $invoice)
    public function convert_form_data_into_array( $form_data = array() )
    {
        $meta_array = array();

//this can be replcaed with PHP array functions
        foreach ( $form_data as $index => $data_array )
        {
            $counter = 0;
            foreach ( $data_array as $data )
            {
                if ( ! isset( $meta_array[$counter] ) )
                {
                    $meta_array[$counter] = array();
                }

                $meta_array[$counter++][$index] = $data;
            }

        }

        return $meta_array;
    }

    public function get_customers_dropdown_options( $include_all = 1 )
    {
        $options = [];

// For Now
        if ( $include_all )
        {
            $options[] = [
                'value' => '',
                'label' => 'All'
            ];
        }

        if ( Auth::user() && Auth::user()->sales_rep_customers )
        {
            $sales_rep_customers = json_decode( Auth::user()->sales_rep_customers, true );

            foreach ( $sales_rep_customers['Customers'] as $customer )
            {
                $options[] = [
                    'value' => $customer['CustomerID'],
                    'label' => "{$customer['CompanyName']} ({$customer['CustomerID']})"
                ];
            }

        }

        return $options;
    }

}
