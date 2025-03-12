<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\CacheController;
use App\Http\Controllers\Admin\ThemeController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\FormController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ItemController;
use App\Http\Controllers\Dashboard\ShopController;
use App\Http\Controllers\Admin\ShowroomsController;
use App\Http\Controllers\Admin\CatalogsController;
use App\Http\Controllers\Dashboard\StaffController;
use App\Http\Controllers\Frontend\DesignController;
use App\Http\Controllers\Frontend\FilterController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Admin\PageSettingController;
use App\Http\Controllers\Dashboard\AccountController;
use App\Http\Controllers\Dashboard\FinanceController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Admin\BasicSettingController;
use App\Http\Controllers\Dashboard\HangtagsController;
use App\Http\Controllers\Dashboard\ShippingController;
use App\Http\Controllers\Frontend\FavouriteController;
use App\Http\Controllers\Frontend\CollectionsController;
use App\Http\Controllers\Frontend\MainCollectionController;
use App\Http\Controllers\Dashboard\GenericReportsController;
use App\Http\Controllers\Admin\DealerRegistrationsController;
use App\Http\Controllers\Admin\ApiContentManagementController;
use App\Http\Controllers\Admin\FormController as AdminFormController;
use Mews\Captcha\Facades\Captcha;

//Auth Routes
Auth::routes();
Route::post( '/login', 'Auth\LoginController@authenticate_normal' )->name( 'auth.login' );
Route::post( '/forgot', 'Auth\LoginController@forgot_password' )->name( 'auth.forgot' );
Route::post( '/ajax/login', 'Auth\LoginController@authenticate_ajax' )->name( 'auth.ajax.login' );
Route::get( '/logout', 'Auth\LoginController@logout' )->name( 'auth.logout' );

Route::get('forget-password', 'Auth\ForgotPasswordController@show_forget_password')->name('forget.password.get');
Route::post('forget-password', 'Auth\ForgotPasswordController@submit_forget_password')->name('forget.password.post');
Route::get('reset-password/{token}', 'Auth\ForgotPasswordController@show_reset_password')->name('reset.password.get');
Route::post('reset-password', 'Auth\ForgotPasswordController@submit_reset_password')->name('reset.password.post');

Route::post( '/register', [RegisterController::class, 'register'] )->name( 'auth.register' );

//Home Routes
Route::get( '/', [HomeController::class, 'index'] )->name( 'frontend.home' );
Route::get( '/catalogs', [HomeController::class, 'catalogs'] )->name( 'frontend.catalogs' );
//Category Routes
Route::get( '/maincollection', [MainCollectionController::class, 'index'] )->name( 'frontend.maincollection' );
Route::get( '/subcollection/', [MainCollectionController::class, 'subcollection'] )->name( 'frontend.subcollection' );
//Favourite Routes
Route::get( '/favourites/{id}', [FavouriteController::class, 'index'] )->name( 'frontend.favourite' );
Route::get( '/favourites/static/{type}', [FavouriteController::class, 'static_fav_page'] )->name( 'frontend.static-favourite' );
//Collection & Filter based Routes (Collections, Colors, Lifestyle)
Route::get( '/collections/{id}/{type}', [CollectionsController::class, 'index'] )->name( 'frontend.collections' );
Route::post( '/collections/{id}/{type}/{page}', [CollectionsController::class, 'get_paginated_collections'] )->name( 'frontend.collections_page' );
//Filter Routes (New Arrivals, Special Buys, Top Sellers)
Route::get( '/filters/{type}', [FilterController::class, 'index'] )->name( 'frontend.filters' );
//Design Routes
Route::get( '/designs/{id}/{filter}/{type}', [DesignController::class, 'index'] )->name( 'frontend.designs' );
Route::get( '/collections/{id}/{type}/{filter}', [CollectionsController::class, 'collection_with_filters'] )->name( 'frontend.collection_with_filters' );
// TODO - NEEDS TO BE ADJUSTED WITH PROPER FILTERS
Route::get( '/designs/{id}/{filter}/{type}/{with_title}', [DesignController::class, 'index'] )->name( 'frontend.designs_with_title' );
Route::post( '/designs/{id}/{filter}/{type}/{page}', [DesignController::class, 'get_paginated_designs'] )->name( 'frontend.designs_page' );
Route::post( '/designs/{id}/{filter}/{type}/{with_title}/{page}', [DesignController::class, 'get_paginated_designs'] )->name( 'frontend.designs_page' );
//Item Routes
Route::get( '/item/{id}/{designId}/{colorId?}', [ItemController::class, 'index'] )->name( 'frontend.item' );
Route::post( '/item/ats', [ItemController::class, 'get_item_ats'] )->name( 'frontend.item.ats' );
//Search Routes
Route::get( '/search/{string}/{type?}', [SearchController::class, 'index'] )->name( 'frontend.search' );

//Add-To-Cart Routes
Route::post( '/cart/add/', [CartController::class, 'add'] )->name( 'frontend.cart.add' );
Route::post( '/cart/refresh/{type}', [CartController::class, 'refresh'] )->name( 'frontend.cart.refresh' );
Route::post( '/cart/update/', [CartController::class, 'update'] )->name( 'frontend.cart.update' );
Route::post( '/cart/sidemark/update/', [CartController::class, 'update_sidemark'] )->name( 'frontend.cart.update_sidemark' );
Route::post( '/cart/remove/', [CartController::class, 'remove'] )->name( 'frontend.cart.remove' );

//TODO : Checkout Routes - THIS IS NOT WORKING
Route::group( ['prefix' => 'checkout', 'middleware' => ['auth']], function ()
{
    Route::get( '/', [CheckoutController::class, 'index'] )->name( 'frontend.checkout' );
    Route::post( '/place-order', [CheckoutController::class, 'place_order'] )->name( 'frontend.checkout.place_order' );
    Route::post( '/shipping-rate', [CheckoutController::class, 'shipping_rate'] )->name( 'frontend.checkout.shipping-rate' );
    Route::get( '/thank-you/{msg}', 'Frontend\CheckoutController@thankYou' );
    Route::get( '/pt/security/', [CheckoutController::class, 'pt_security'] )->name( 'checkout.security' );
    Route::post( '/states', [CheckoutController::class, 'get_country_states'] )->name( 'checkout.states' );
} );

//Form routes (contact us, feedback, careers)
Route::get( '/forms/{slug}', [FormController::class, 'index'] )->name( 'form.show' );
Route::post( '/forms/{slug}', [FormController::class, 'submission_request'] )->name( 'form.submission' );
Route::post( '/forms/store/{slug}', 'Frontend\FormController@store' )->name( 'form.store' );

//Static pages routes (showrooms, faqs, aboutus)
Route::get( '/static/{type}', 'Frontend\StaticController@index' )->name( 'static.show' );

//Admin Routes
Route::redirect( '/admin', '/admin/themes' );
Route::group( ['prefix' => 'admin', 'middleware' => ['auth']], function ()
{
    Route::get( '/orders', [OrdersController::class, 'index'] )->name( 'admin.orders' );
    Route::post( '/orders', [OrdersController::class, 'process_order'] )->name( 'admin.process-orders' );
    Route::get( '/dealer-registrations', [DealerRegistrationsController::class, 'index'] )->name( 'admin.dealer-registrations' );
    Route::post( '/dealer-registrations', [DealerRegistrationsController::class, 'process_dealer_registration'] )->name( 'admin.process-dealer-registrations' );
    Route::get( '/cache-management', [CacheController::class, 'index'] )->name( 'admin.cache-management' );
    Route::post( '/cache-management', [CacheController::class, 'clear_cache'] )->name( 'admin.clear-cache' );
    Route::get( '/page-setting/{id}', [PageSettingController::class, 'index'] )->name( 'admin.page_setting' );
    Route::post( '/page-setting/update/{page_id}', [PageSettingController::class, 'update'] )->name( 'admin.page_setting.update' );
    Route::get( '/themes', [ThemeController::class, 'index'] )->name( 'admin.themes' );
    Route::get( '/themes/refresh', [ThemeController::class, 'refresh_themes'] )->name( 'admin.refresh_themes' );
    Route::get( '/themes/activate/{theme_id}', [ThemeController::class, 'activate_theme'] )->name( 'admin.activate_theme' );
    Route::get( '/themes/deactivate/{theme_id}', [ThemeController::class, 'de_activate_theme'] )->name( 'admin.de_activate_theme' );
    Route::get( '/slider/{slider_id}', [SliderController::class, 'index'] )->name( 'admin.slider' );
    Route::post( '/slider/store/{slider_id}', [SliderController::class, 'store'] )->name( 'admin.slider.store' );
    Route::post( '/slider/update/{slider_id}/{meta_id}', [SliderController::class, 'update'] )->name( 'admin.slider.update' );

    Route::get( '/showroom/{showroom_id}', [ShowroomsController::class, 'index'] )->name( 'admin.showroom' );
    Route::post( '/showroom/store/{showroom_id}', [ShowroomsController::class, 'store'] )->name( 'admin.showroom.store' );
    Route::post( '/showroom/update/{showroom_id}/{meta_id}', [ShowroomsController::class, 'update'] )->name( 'admin.showroom.update' );

    Route::get( '/catalog/{catalog_id}', [CatalogsController::class, 'index'] )->name( 'admin.catalog' );
    Route::post( '/catalog/store/{catalog_id}', [CatalogsController::class, 'store'] )->name( 'admin.catalog.store' );
    Route::post( '/catalog/update/{catalog_id}/{meta_id}', [CatalogsController::class, 'update'] )->name( 'admin.catalog.update' );

    Route::get( '/basic-settings', [BasicSettingController::class, 'index'] )->name( 'admin.basic_settings' );
    Route::post( '/update-settings/{id}', [BasicSettingController::class, 'update'] )->name( 'admin.update_settings' );
    Route::get( '/menu/{menu_id}', [MenuController::class, 'index'] )->name( 'admin.menu' );
    Route::post( '/menu/update/{menu_id}', [MenuController::class, 'update'] )->name( 'admin.menu.update' );
    Route::get( '/slider-meta/delete/{slider_id}/{meta_id}', [SliderController::class, 'destroy'] )->name( 'admin.slider_meta.delete' );
    Route::get( '/slider-meta/edit/{slider_id}/{meta_id}', [SliderController::class, 'edit'] )->name( 'admin.slider_meta.edit' );
    Route::get( '/slider-meta/create/{slider_id}', [SliderController::class, 'create'] )->name( 'admin.slider_meta.create' );

    Route::get( '/showroom-meta/delete/{showroom_id}/{meta_id}', [ShowroomsController::class, 'destroy'] )->name( 'admin.showroom_meta.delete' );
    Route::get( '/showroom-meta/edit/{showroom_id}/{meta_id}', [ShowroomsController::class, 'edit'] )->name( 'admin.showroom_meta.edit' );
    Route::get( '/showroom-meta/create/{showroom_id}', [ShowroomsController::class, 'create'] )->name( 'admin.showroom_meta.create' );

    Route::get( '/catalog-meta/delete/{catalog_id}/{meta_id}', [CatalogsController::class, 'destroy'] )->name( 'admin.catalog_meta.delete' );
    Route::get( '/catalog-meta/edit/{catalog_id}/{meta_id}', [CatalogsController::class, 'edit'] )->name( 'admin.catalog_meta.edit' );
    Route::get( '/catalog-meta/create/{catalog_id}', [CatalogsController::class, 'create'] )->name( 'admin.catalog_meta.create' );

    // Route::get( '/forms/{slug}', [FormsController::class, 'index'] )->name( 'admin.form' );
    Route::get( '/forms/{slug}', [AdminFormController::class, 'show_submissions'] )->name( 'admin.forms' );
    Route::get( '/favourites/{id}', [ApiContentManagementController::class, 'get_favourities_content'] )->name( 'admin.favourite' );
    Route::post( '/update-api-content', [ApiContentManagementController::class, 'save_api_content'] )->name( 'admin.modify-api-content' );
    Route::get( '/favourites/{id}/collections/{page?}/{filter?}', [ApiContentManagementController::class, 'get_collections_content'] )->name( 'admin.collections' );
} );

// TODO : Dynamic forms need to work
/*
Route::get('/admin/submissions/contact/show/{id}', 'admin\ContactUsController@show')->name('admin.submissions.show_contact');
Route::get('/admin/submissions/feedback', 'admin\FeedbackController@index')->name('admin.submissions.feedback');
Route::get('/admin/submissions/feedback/show/{id}', 'admin\FeedbackController@show')->name('admin.submissions.show_feedback');;
Route::get('/admin/submissions/career', 'admin\CareersController@index')->name('admin.submissions.career');
Route::get('/admin/submissions/career/show/{id}', 'admin\CareersController@show')->name('admin.submissions.show_career');
 */
// TODO : The base redirects are throwing 404 and 301 errors - Adil needs to check
Route::redirect( '/dashboard', '/dashboard/home' );

Route::redirect( '/dashboard/dashboard', '/dashboard/home' );
Route::group( ['prefix' => 'dashboard', 'middleware' => ['auth']], function ()
{
    Route::get( '/home', [AccountController::class, 'dashboard'] )->name( 'dashboard' );

    // Dashboard Account Routes
    Route::get( '/my-account', [AccountController::class, 'my_account'] )->name( 'dashboard.myaccount' );
    Route::post( '/my-account', [AccountController::class, 'account_update'] )->name( 'dashboard.myaccount.update' );
    Route::post( '/my-account/change-password', [AccountController::class, 'change_password'] )->name( 'dashboard.myaccount.changepass' );
    Route::get( '/account-information', [AccountController::class, 'account_information'] )->name( 'dashboard.accountinfo' );
    Route::post( '/update-customer-address', [AccountController::class, 'update_customer_address'] )->name( 'dashboard.updatecustomeraddress' );
    Route::get( '/document', [AccountController::class, 'document'] )->name( 'dashboard.document' );

    //Staff Routes
    Route::get( '/staff', [StaffController::class, 'index'] )->name( 'dashboard.staff' );
    Route::post( '/staff', [StaffController::class, 'search'] )->name( 'dashboard.staff.search' );
    Route::get( '/staff/create', [StaffController::class, 'create'] )->name( 'dashboard.staff.create' );
    Route::post( '/staff/create', [StaffController::class, 'save'] )->name( 'dashboard.staff.save' );
    Route::get( '/staff/{id}', [StaffController::class, 'fetch'] )->name( 'dashboard.staff.fetch' );
    Route::post( '/staff/{id}', [StaffController::class, 'update'] )->name( 'dashboard.staff.update' );
    Route::delete( '/staff/{id}', [StaffController::class, 'destroy'] )->name( 'dashboard.staff.delete' );

    //Dashboard Finance Routes
    Route::get( '/company-credit', [GenericReportsController::class, 'company_credit'] )->name( 'dashboard.companycredit' );
    Route::get( '/generic-report', [GenericReportsController::class, 'credit_memos'] )->name( 'dashboard.creditmemos' );
    Route::get( '/financial-transactions', [GenericReportsController::class, 'financial_transactions'] )->name( 'dashboard.financialtransactions' );
    Route::get( '/invoice', [GenericReportsController::class, 'invoice'] )->name( 'dashboard.invoice' );
    Route::get( '/payment-options', [FinanceController::class, 'payment_options'] )->name( 'dashboard.paymentoptions' );
    Route::post( '/payment-options', [FinanceController::class, 'save_payment_options'] )->name( 'dashboard.savepaymentoptions' );

    //Dashboard Shop Routes
    Route::get( '/express-order', [ShopController::class, 'express_order'] )->name( 'dashboard.expressorder' );
    Route::get( '/place-order', [ShopController::class, 'place_order'] )->name( 'dashboard.placeorder' );
    Route::post( '/place-order/get-items', [ShopController::class, 'get_design_items'] )->name( 'dashboard.placeorder.get-items' );
    Route::post( '/place-order/additional-filters', [ShopController::class, 'get_additional_filters'] )->name( 'dashboard.placeorder.additional-filters' );
    Route::post( '/place-order', [ShopController::class, 'place_order'] )->name( 'dashboard.placeorder' );
    Route::post( '/get-customer-addresses', [ShopController::class, 'get_customer_addresses'] )->name( 'dashboard.customeraddresses' );
    Route::get( '/view-order', [GenericReportsController::class, 'view_order'] )->name( 'dashboard.vieworder' );
    Route::get( '/initiate-return', [ShopController::class, 'init_return'] )->name( 'dashboard.initreturn' );
    Route::get( '/view-return', [GenericReportsController::class, 'view_return'] )->name( 'dashboard.viewreturn' );
    Route::get( '/hangtags', [HangtagsController::class, 'index'] )->name( 'dashboard.hangtags' );
    Route::post( '/collection/designs', [HangtagsController::class, 'get_collection_designs'] )->name( 'dashboard.hangtags-collection-designs' );
    Route::post( '/collection/colors', [HangtagsController::class, 'get_collection_colors'] )->name( 'dashboard.hangtags-collection-colors' );
    Route::get( '/hangtags/fetch', [HangtagsController::class, 'redirect_to_index'] )->name( 'dashboard.hangtags-fetch' );
    Route::post( '/hangtags/fetch', [HangtagsController::class, 'fetch_hangtags'] )->name( 'dashboard.hangtags-fetch' );
    Route::post( '/hangtags/print-download', [HangtagsController::class, 'download_print_hangtags'] )->name( 'dashboard.hangtags-print-download' );

    //Dashboard Shipping Routes
    Route::get( '/freight-estimator', [ShippingController::class, 'freight_estimator'] )->name( 'dashboard.freightestimator' );

    // Sample files
    Route::get( '/sample/{type}', [GenericReportsController::class, 'download_sample_files'] )->name( 'dashboard.samplefiles' );

    //print order report
    Route::post( '/view-order/print-download', [GenericReportsController::class, 'download_print_orders'] )->name( 'dashboard.orders-print-download' );

} );

Route::get('/captcha-refresh', function () {
    return Captcha::img();
})->name('captcha.refresh');
