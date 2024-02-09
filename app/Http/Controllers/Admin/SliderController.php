<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;
use App\Models\Page;
use App\Models\SliderMeta;
use Illuminate\Http\File;
use Illuminate\Http\Request;

class SliderController extends AdminController
{
    // TODO : if slider is not active then it should not show on the front end

    private $model_slider_meta;
    private $validation_array;
    public function __construct(){
        $this->validation_array = [
            'caption_1' => 'required|max:37',
            'caption_2' => 'required|max:35',
            'is_active' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ];
        $this->model_slider_meta = new SliderMeta();
        $this->middleware('auth');
        parent::__construct();
    }
    public function index($slider_id='')
    {
        $slider_meta = $this->model_slider_meta->get_slider_meta($slider_id);
        return view('admin.slider',['slider_meta'=> $slider_meta,'slider_id' => $slider_id]);
    }

    public function create($slider_id)
    {
        return view('admin.slider-meta',['slider_id' => $slider_id]);
    }

    public function store(Request $request,$slider_id)
    {
        $request->validate($this->validation_array);
        $this->model_slider_meta->caption_1 = $request->caption_1;
        $this->model_slider_meta->caption_2 = $request->caption_2;
        $this->model_slider_meta->is_active = $request->is_active;
        // $this->model_slider_meta->image = $request->image->store('storage');
        $this->model_slider_meta->image = CommonController::upload_file_ftp($request->image);
        $this->model_slider_meta->slider_id = $slider_id;
        $this->model_slider_meta->save();
        return redirect()->route('admin.slider',[$slider_id]);
    }

    public function edit($slider_id, $meta_id)
    {
        $slider_meta = $this->model_slider_meta->get_single_meta($meta_id);
        return view('admin.slider-meta',['slider_meta'=>$slider_meta,'slider_id' => $slider_id]);
    }

    public function update(Request $request, $slider_id, $meta_id)
    {
        $request->validate($this->validation_array);
        $dataArray =[];
        if ($request->hasFile('image')) 
        {
            // $dataArray['image'] = $request->image->store('storage');
            $dataArray['image'] = CommonController::upload_file_ftp($request->image);
        }
        $dataArray['caption_1'] = $request->caption_1;
        $dataArray['caption_2'] = $request->caption_2;
        $dataArray['is_active'] = $request->is_active;
        $this->model_slider_meta->update_meta($meta_id,$dataArray);
        return redirect()->route('admin.slider',['slider_id' => $slider_id]);
    }

    public function destroy($slider_id,$meta_id)
    {
        $this->model_slider_meta->destroy($meta_id);
        return redirect()->route('admin.slider',['slider_id' => $slider_id]);
    }
}
