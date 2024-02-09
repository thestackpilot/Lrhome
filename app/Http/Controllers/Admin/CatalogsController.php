<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\CommonController;
use App\Models\Page;
use App\Models\CatalogsMeta;
use Illuminate\Http\File;
use Illuminate\Http\Request;

class CatalogsController extends AdminController
{
    //
    private $model_catalog_meta;
    private $validation_array;
    public function __construct(){
        $this->validation_array = [
            'title' => 'required|max:255',
            'caption' => 'required|max:255',
            'catalog_pdf' => 'required|max:255',
            'image' => 'image|mimes:jpeg,png,jpg',
        ];
        $this->model_catalog_meta = new CatalogsMeta();
        $this->middleware('auth');
        parent::__construct();
    }
    public function index($catalog_id='')
    {
        $catalog_meta = $this->model_catalog_meta->get_catalog_meta($catalog_id);
        return view('admin.catalog',['catalog_meta'=> $catalog_meta,'catalog_id' => $catalog_id]);
    }

    public function create($catalog_id)
    {
        return view('admin.catalog-meta',['catalog_id' => $catalog_id]);
    }

    public function store(Request $request,$catalog_id)
    {
        $request->validate($this->validation_array);
        $this->model_catalog_meta->title        = $request->title;
        $this->model_catalog_meta->caption      = $request->caption;
        $this->model_catalog_meta->catalog_pdf  = $request->catalog_pdf;
        if (isset($request->image)) {
            // $this->model_catalog_meta->image = $request->image->store('storage');
            $this->model_catalog_meta->image = CommonController::upload_file_ftp($request->image);
        }
        $this->model_catalog_meta->is_active = $request->is_active;
        $this->model_catalog_meta->catalog_id = $catalog_id;
        $this->model_catalog_meta->save();
        return redirect()->route('admin.catalog',[$catalog_id]);
    }

    public function edit($catalog_id, $meta_id)
    {
        $catalog_meta = $this->model_catalog_meta->get_single_meta($meta_id);
        return view('admin.catalog-meta',['catalog_meta'=>$catalog_meta,'catalog_id' => $catalog_id]);
    }

    public function update(Request $request, $catalog_id, $meta_id)
    {
        $request->validate($this->validation_array);
        $dataArray =[];
        if ($request->hasFile('image')) 
        {
            // $dataArray['image'] = $request->image->store('storage');
            $dataArray['image'] = CommonController::upload_file_ftp($request->image);
        }
        $dataArray['title'] = $request->title;
        $dataArray['caption'] = $request->caption;
        $dataArray['catalog_pdf'] = $request->catalog_pdf;
        $dataArray['is_active'] = $request->is_active;
        $this->model_catalog_meta->update_meta($meta_id,$dataArray);
        return redirect()->route('admin.catalog',['catalog_id' => $catalog_id]);
    }

    public function destroy($catalog_id,$meta_id)
    {
        $this->model_catalog_meta->destroy($meta_id);
        return redirect()->route('admin.catalog',['catalog_id' => $catalog_id]);
    }
}
