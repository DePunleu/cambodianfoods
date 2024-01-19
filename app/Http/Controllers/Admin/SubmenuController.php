<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Submenu;

class SubmenuController extends Controller
{
    //==================Show All Submenu=======================//
    public function submenu() {
        $submenu = Submenu::orderByDesc('id')->get();
        $count = 1;
        return view(
            'admin.home.submenu.list_submenu',
            compact(
                'count',
                'submenu'
            )
        );
    }
    //==================End Method=======================//

    //==================Show Create Submenu Form=======================//
    public function create_submenu() {
        return view('admin.home.submenu.create_submenu');
    }
    //==================End Method=======================//

    //==================Store Create submenu =======================//
    public function create_submenuPost(Request $request) {
        $request->validate([
            'submenu_name' => [
                'required',
                Rule::unique('submenus', 'submenu_name'),
            ],
            'menu_id' => 'required',
            
        ]);
        $data['submenu_name'] = $request -> submenu_name;
        $data['menu_id'] = $request -> menu_id;
        Submenu::create($data);
        return redirect()->back()->with("success","Submenu Created success!");
    }

    //==================End Method=======================//
    //==================Show Update Submenu Form =======================//

    public function update_submenu($id)
    {
        $submenu = Submenu::where('id',$id)->first();
        return view('admin.home.submenu.update_submenu',['submenu'=>$submenu]);

    }
    //==================End Method=======================//
    //================== Store Update Submenu=======================//
    public function update_submenuPost(Request $request, $id)
    {
        $request->validate([
            'submenu_name' => [
                'required',
            
                Rule::unique('submenus', 'submenu_name'),
            ],
        ]);
        $submenu = Submenu::find($id);
        $submenu->submenu_name=$request->submenu_name;
        $submenu->save();

        return redirect()->back()->with("success","Updated Submenu successfully!");
    }
    //==================End Method=======================//

    //==================Delete Submenu=======================//
    public function delete_submenu($id_submenu) {
        $delete = Submenu::where('id', $id_submenu)->first();
        $delete->delete();
        return redirect('/admin/submenu')
        ->with("success","submenu deleted successfully!");
    }

    //==================End Method=======================//

    //     // Modify the submenu method
    // public function submenus(Request $request) {
    //     $menus = [
    //         1 => 'Food',
    //         2 => 'Combo',
    //         3 => 'Dessert',
    //         4 => 'Drink',
    //     ];

    //     $selectedMenu = $request->input('menu_id');
    //     $submenuQuery = Submenu::orderByDesc('id');

    //     if (!empty($selectedMenu) && array_key_exists($selectedMenu, $menus)) {
    //         $submenuQuery->where('menu_id', $selectedMenu);
    //     }

    //     $submenu = $submenuQuery->get();
    //     $count = 1;

    //     return view(
    //         'admin.home.submenu.list_submenu',
    //         compact('count', 'submenu', 'menus', 'selectedMenu')
    //     );
        //}

    
}
