<?php

namespace App\Http\Controllers\Auth;
//Laravel macros
//Application Models
use App\Models\BasicSetting;
//Base Controllers
use App\Http\Controllers\RootController;
use App\Http\Controllers\ApisController;
use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\Frontend\FrontendController;
//Base View
use View;

class AuthController extends FrontendController
{
    public $ApiObj;

    public function __construct()
    {
        parent::__construct();
    }
}
