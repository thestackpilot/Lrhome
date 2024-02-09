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
        $this->menu_model->update_is_active($menu_id,$request-> is_active);
        $meta_array = $this->create_menu_meta_array($menu_id, $request->key, $request->title, $request->url, $request->parent, $request->image);
        $this-> menu_meta_model-> update_meta($menu_id ,$meta_array);
        return redirect()->route('admin.menu',['menu_id' => $menu_id]);
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
