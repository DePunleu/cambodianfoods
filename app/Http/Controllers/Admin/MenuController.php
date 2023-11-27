<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Menu;

class MenuController extends Controller
{
    //==================Show All Menu=======================//
    public function menu() {
        $menu = Menu::orderByDesc('id')->get();
        $count = 1;
        return view(
            'admin.home.menu.list_menu',
            compact(
                'count',
                'menu'
            )
        );
    }
    //==================End Method=======================//

    //==================Show Create Menu Form=======================//
    public function create_menu() {
        return view('admin.home.menu.create_menu');
    }
    //==================End Method=======================//

    //==================Store Create Menu =======================//
    public function create_menuPost(Request $request) {
        $request->validate([
            'menu_name' => [
                'required',
                Rule::unique('menus', 'name_menu'),
            ],
            'menu_description' => 'required',
        ]);
        $data['name_menu'] = $request -> menu_name;
        $data['description'] = $request -> menu_description;
        Menu::create($data);
        return redirect()->back()->with("success","Menu Created success!");
    }

    //==================End Method=======================//
    //==================Show Update Menu Form =======================//

    public function update_menu($id)
    {
        $menu = Menu::where('id',$id)->first();
        return view('admin.home.menu.update_menu',['menu'=>$menu]);

    }
    //==================End Method=======================//
    //================== Store Update Menu=======================//
    public function update_menuPost(Request $request, $id)
    {
        $request->validate([
            'menu_name' => [
                'required',
                Rule::unique('menus', 'name_menu'),
            ],
            'menu_description' => 'required',
        ]);
        $menu = Menu::find($id);
        $menu->name_menu=$request->menu_name;
        $menu->description=$request->menu_description;
        $menu->save();
        return redirect()->back()->with("success","Updated Menu successfully!");
    }
    //==================End Method=======================//

    //==================Delete Menu=======================//
    public function delete_menu($id_menu) {
        $delete = Menu::where('id', $id_menu)->first();
        $delete->delete();
        return redirect('/admin/menu')
        ->with("success","Menu deleted successfully!");
    }

    //==================End Method=======================//
    
}
