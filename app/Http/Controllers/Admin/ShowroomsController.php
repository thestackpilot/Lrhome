<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;
use App\Models\Page;
use App\Models\ShowroomsMeta;
use Illuminate\Http\File;
use Illuminate\Http\Request;

class ShowroomsController extends AdminController
{
    //
    private $model_showroom_meta;
    private $validation_array;
    public function __construct(){
        $this->validation_array = [
            'title' => 'required|max:255',
            'area' => 'required|max:255',
            'is_active' => 'required',
            'address' => 'required|max:255',
            'image' => 'image|mimes:jpeg,png,jpg',
        ];
        $this->model_showroom_meta = new ShowroomsMeta();
        $this->middleware('auth');
        parent::__construct();
    }
    public function index($showroom_id='')
    {
        $showroom_meta = $this->model_showroom_meta->get_showroom_meta($showroom_id);
        return view('admin.showroom',['showroom_meta'=> $showroom_meta,'showroom_id' => $showroom_id]);
    }

    public function create($showroom_id)
    {
        return view('admin.showroom-meta',['showroom_id' => $showroom_id]);
    }

    public function store(Request $request,$showroom_id)
    {
        $request->validate($this->validation_array);
        $this->model_showroom_meta->title = $request->title;
        $this->model_showroom_meta->area = $request->area;
        $this->model_showroom_meta->address = $request->address;
        if (isset($request->image)) {
            // $this->model_showroom_meta->image = $request->image->store('storage');
            $this->model_showroom_meta->image = CommonController::upload_file_ftp($request->image);
        }
        $this->model_showroom_meta->is_active = $request->is_active;
        $this->model_showroom_meta->showroom_id = $showroom_id;
        $this->model_showroom_meta->save();
        return redirect()->route('admin.showroom',[$showroom_id]);
    }

    public function edit($showroom_id, $meta_id)
    {
        $showroom_meta = $this->model_showroom_meta->get_single_meta($meta_id);
        return view('admin.showroom-meta',['showroom_meta'=>$showroom_meta,'showroom_id' => $showroom_id]);
    }

    public function update(Request $request, $showroom_id, $meta_id)
    {
        $request->validate($this->validation_array);
        $dataArray =[];
        if ($request->hasFile('image')) 
        {
            // $dataArray['image'] = $request->image->store('storage');
            $dataArray['image'] = CommonController::upload_file_ftp($request->image);
        }
        $dataArray['title'] = $request->title;
        $dataArray['area'] = $request->area;
        $dataArray['address'] = $request->address;
        $dataArray['is_active'] = $request->is_active;
        $this->model_showroom_meta->update_meta($meta_id,$dataArray);
        return redirect()->route('admin.showroom',['showroom_id' => $showroom_id]);
    }

    public function destroy($showroom_id,$meta_id)
    {
        $this->model_showroom_meta->destroy($meta_id);
        return redirect()->route('admin.showroom',['showroom_id' => $showroom_id]);
    }
}
