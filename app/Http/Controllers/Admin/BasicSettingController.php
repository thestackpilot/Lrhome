<?php

namespace App\Http\Controllers\Admin;

use App\Models\BasicSetting;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;

use App\Models\Page;
use Illuminate\Http\Request;

class BasicSettingController extends AdminController
{
    public $pages,$customRoutes;
    private $obj_model_basic_setting;
    
    public function __construct()
    {
        $this->obj_model_basic_setting = new BasicSetting();
        parent::__construct();
    }

    public function index()
    {
        $settings = $this->obj_model_basic_setting->get_all_settings($this-> active_theme-> id);
        return view('admin.basic-settings',['settings' => $settings]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|max:50',
            'name' => 'required|max:50',
            'contact' => 'required|max:20',
            'address' => 'required|max:50',
            'website' => 'required|max:30',
            'logo_dark' => 'image|mimes:jpeg,png,jpg,svg',
            'logo_light' => 'image|mimes:jpeg,png,jpg,svg',
        ]);
        $dataArray =[];
        $requestData = $request->all();
        if ($request->hasFile('logo_dark')) 
        {
            // $dataArray['logo_dark'] = $request->logo_dark->store('storage');
            $dataArray['logo_dark'] = CommonController::upload_file_ftp($request->logo_dark);
        }
        if($request->hasFile('logo_light'))
        {
            // $dataArray['logo_light'] = $request->logo_light->store('storage');
            $dataArray['logo_light'] = CommonController::upload_file_ftp($request->logo_light);
        }
        $dataArray['email'] = $requestData['email'];
        $dataArray['name'] = $requestData['name'];
        $dataArray['contact'] = $requestData['contact'];
        $dataArray['address'] = $requestData['address'];
        $dataArray['website'] = $requestData['website'];
        $this->obj_model_basic_setting->update_settings($id,$dataArray);
        return redirect()->route('admin.basic_settings');
    }
}
