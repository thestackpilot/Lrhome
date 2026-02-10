<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Menu;
use App\Models\MenuMeta;
use App\Models\Page;
use Illuminate\Http\Request;

class MenuController extends AdminController
{
    private $menu_meta_model;
    public function __construct()
    {
        parent::__construct();
        $this-> menu_meta_model = new MenuMeta();
    }

    public function index($menu_id)
    {
	    $menu_metas_with_parent = $this-> menu_model->get_menu_with_meta($menu_id);
        return view('admin.menu',['menu' => $menu_metas_with_parent]);
    }

    public function update(Request $request, $menu_id)
    {
      
         if($request->image_file){
            foreach(array_keys($request->image_file) as $val){
               $url= $this->upload_image_remove_old($request,$val);
               if ($url) {
                                $updatedImages = $request->image; // get current array
                                $updatedImages[$val] = $url;      // update the specific index

                                $request->merge(['image' => $updatedImages]); // merge back
                            }
            }
         }
        $this->menu_model->update_is_active($menu_id,$request-> is_active);  // will update item is active or not etc
        $meta_array = $this->create_menu_meta_array($menu_id, $request->key, $request->title, $request->url, $request->parent, $request->image);
        $this-> menu_meta_model-> update_meta($menu_id ,$meta_array);
        return redirect()->route('admin.menu',['menu_id' => $menu_id]);
    }
    
        public function upload_image_remove_old(&$request, $val)
    {
        // Remove old image if exists
        $oldUrl = $request->image[$val] ?? null;
        if ($oldUrl) {
            $relativePath = parse_url($oldUrl, PHP_URL_PATH); // /media/images/abc.jpg
            $localPath = public_path($relativePath);
            if (file_exists($localPath)) {
                unlink($localPath);
            }
        }

        // Upload new image
        $image = $request->image_file[$val] ?? null;
        if ($image) {
            $name = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $location = public_path('media/images');

            if (!file_exists($location)) {
                mkdir($location, 0755, true);
            }

            $movedFile = $image->move($location, $name);

            // Relative path for DB
            $relativePath = 'media/images/' . $movedFile->getFilename();

            // URL for frontend
            $url = asset($relativePath);

            // Update request variable with URL (or you can store $relativePath if you prefer)
            // $request->image[$val] = $url;

            return $url;
        }
    }

    public function create_menu_meta_array($menu_id, $keys, $titles, $urls, $parents, $images)
    {
        $final_meta_array = [];
        $i = 0;
        $meta_array = [];
        foreach ($titles as $title)  //this can be replcaed with PHP array functions
        {
            $meta_array['menu_id'] = $menu_id;
            $meta_array['meta_key'] = $keys[$i];
            $meta_array['meta_title'] = $title;
            $meta_array['meta_url'] = $urls[$i];
            $meta_array['meta_parent_key'] = $parents[$i];
            $meta_array['meta_image'] = $images[$i];
            array_push($final_meta_array,$meta_array);
            $i++;
        }
        return $final_meta_array;
    }
}
