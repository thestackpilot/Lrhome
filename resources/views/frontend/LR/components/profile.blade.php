@php
// $active_theme object is available containing the theme developer json loaded.
// This is for the theme developers who want to load further view assets

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

@endphp

    @guest()
    <a href="{{route('auth.login')}}">
        <i class="headericons icon-user quickProfile-opener"></i>
    </a>
    @endguest()
    @auth()
    <i class="headericons icon-user quickProfile-opener"></i>
    <div class="quick-profile col-sm-12 m-md-2 bg-white checkout-balance col-12 d-none">
        <i class="icon-cross position-absolute closeProfile"> </i>
        <div class="d-flex flex-column">
            @php
                $hasManageOrdersPermission = in_array('manage-orders', Auth::user()->getPermissions());
                $hasManageClaimsPermission = in_array('manage-claims', Auth::user()->getPermissions());
            @endphp
            <div class="flex-row justify-content-center upperArea text-center">
                <a href="{{route('dashboard.myaccount')}}" class="profile-img">
                    <h1 class="naming-initials"> {{Auth::user()->firstname ? strtoupper(Auth::user()->firstname)[0] : ''}}{{Auth::user()->lastname ? strtoupper(Auth::user()->lastname)[0] : ''}} </h1>
                </a>
            </div>
            <div class="text-center inner-user-settings">
                <div class="user-information p-0 border-0">
                    <h6 class="user-name">{{Auth::user()->firstname.' '.Auth::user()->lastname}}</h6>
                    <h6 class="user-email">{{Auth::user()->email}}</h6>
                </div>
                <div class="user-settings-block1 p-0">
                    <a href="{{route('dashboard')}}" class="user-settings">
                        <div>Dashboard</div>
                        <i class="icon-user"></i>
                    </a>
                </div>
                @if ( strcmp( ConstantsController::USER_ROLES['admin'], Auth::user()->role ) !== 0 )
                <div class="user-settings-block1 p-0">
                    <a id="custom_cost" class="user-settings">
                        <div>Custom Cost</div>
                        <i class="icon-cog"></i>
                    </a>
                </div>
                @if($hasManageOrdersPermission)
                <div class="user-settings-block1 p-0">
                    <a href="{{route('dashboard.placeorder')}}" class="user-settings">
                        <div>Place Order</div>
                        <i class="icon-cart-plus"></i>
                    </a>
                </div>
                <div class="user-settings-block1 p-0">
                    <a href="{{route('dashboard.vieworder')}}" class="user-settings">
                        <div>View Orders</div>
                        <i class="icon-file-check"></i>
                    </a>
                </div>
                <div class="user-settings-block1 p-0">
                    <a href="{{route('dashboard.invoice')}}" class="user-settings">
                        <div>View Invoices</div>
                        <i class="icon-credit-card"></i>
                    </a>
                </div>
                @endif
                @if($hasManageClaimsPermission)
                <div class="user-settings-block1 p-0">
                    <a href="{{route('dashboard.viewreturn')}}" class="user-settings">
                        <div>View Returns</div>
                        <i class="icon-reply"></i>
                    </a>
                </div>
                @endif
                @endif
                <div class="user-settings-block1 p-0">
                    <a class="user-settings" href="{{route('auth.logout')}}">
                        <div>Logout</div>
                        <i class="fa fa-sign-out"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="cost-type col-sm-12 m-md-2 bg-white checkout-balance col-12 d-none">
        <i class="icon-cross position-absolute closeProfile"> </i>
        <div class="d-flex flex-column">
            <div class="text-center inner-user-settings">
                <h3>Cost Type</h3>
                <form  method="post" action="{{route('dashboard.myaccount.update')}}" class="custom-cost d-flex flex-lg-row flex-sm-column flex-dir-col flex-wrap mt-3 dafault-form p-1 pt-3">
                    @csrf
                    <input type="hidden" name="form-type" value="{{ConstantsController::FORM_TYPES['update-cost-toggle']}}" />
                    <div class="mb-3 col-md-6 pe-1 pe-lg-3">
                        <label for="cost-type" class="form-label">Active Cost Type*</label>
                        <select name="cost-type" id="cost-type" class="form-control">
                            @foreach(ConstantsController::COST_TYPES as $key => $value)
                            <option value="{{$key}}" {{Auth::user() && strcmp($key, Auth::user()->getDataAttribute('cost-type', '')) === 0 ? 'selected' : ''}}>{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-md-6 pe-1 pe-lg-3 my-msrp d-none">
                        <label for="msrp-multiplier" class="form-label">MSRP Multiplier*</label>
                        <input type="number" name="msrp-multiplier" data-required="true"  data-double="true" maxlength="4" max="99.99" min="1" step=".01" id="msrp-multiplier" value="{{Auth::user() ? Auth::user()->getDataAttribute('msrp-multiplier', '') : ''}}" class="form-control" placeholder="1">
                    </div>
                    <div class="mb-3 justify-content-end pe-1 pe-lg-3 col-md-12 d-flex">
                        <button type="submit" class="btn btn-primary text-uppercase mt-2" style="width: 100%;background: #EA7410;color:#fff;font-weight: bold;">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endauth
