<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Menu;
use App\Models\Supplier;
use App\Models\Submenu;


class SellerItemController extends Controller
{
        //==================Show All Item=======================//
        public function item()
        {
            $item = Item::with('menus')->orderByDesc('id')->get(); // Include the menu relationship
            $menus = Menu::all();
            $submenus = Menu::all();
            $count = 1;
        
            return view(
                'seller.home.item.list_item',
                compact('count', 'item', 'menus','submenus')
            );
        }
    


        //==================End Method=======================//

        //==================Create_item=======================//
        public function create_item(){
            $menu = Menu::all();
            $submenus = Submenu::all();
            $supplier = Supplier::all();
            return view('seller.home.item.create_item', compact('menu', 'supplier', 'submenus'));
        }
        //==================End Method=======================//

        //===============Store Create Items========================//

        public function create_itemPost(Request $request){
        // Validate form input
        $validatedData = $request->validate([
            'item_title' => 'required',
            'item_price' => 'required|numeric',
            'item_store_quantity' => 'required|numeric',
            'item_menu' => 'required',
            'item_submenu' => 'required',
            'item_supplier' => 'required',
            'item_description' => 'required',
            'item_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust image validation rules as needed
        ]);

        $data['title'] = $validatedData['item_title'];
        $data['price'] = $validatedData['item_price'];
        $data['store_quantity'] = $validatedData['item_store_quantity'];
        $data['created_at'] = now();

        // Retrieve the selected menu
        $menu = Menu::findOrFail($validatedData['item_menu']);
        $data['menu_id'] = $menu->id;

        // Retrieve the selected submenu
        $submenu = Submenu::findOrFail($validatedData['item_submenu']);
        $data['submenu_id'] = $submenu->id;

        // Retrieve the selected supplier
        $supplier = Supplier::where('name_supplier', $validatedData['item_supplier'])->firstOrFail();
        $data['supplier_id'] = $supplier->id;

        $data['description'] = $validatedData['item_description'];

        // Handle file upload (if an image is uploaded)
        if ($request->hasFile('item_image')) {
            $image = $request->file('item_image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('upload/item_images'), $filename);
            $data['image'] = $filename;
        }

        // Create the item
        Item::create($data);

        return redirect()->back()->with("success", "Item created successfully!");
    }

    //==================Delete Item=======================//
    public function delete_item($id_item)
    {
        $delete = Item::where('id', $id_item)->first();
        $delete->delete();
        return redirect('/seller/item')
        ->with("success","Item deleted successfully!");
    }
    //=====================End Method==========================//

     //==================Show Update Item Form=======================//
     public function update_item($id)
     {
         $item = Item::where('id',$id)->first();
         $menu = Menu::all();
         $supplier = Supplier::all();
         $submenu = Submenu::all();
         return view('seller.home.item.update_item',compact('item','menu','supplier','submenu'));
     }
     //=====================End Method==========================//
     //==================Store Update Item =======================//
     public function update_itemPost(Request $request, $id)
     {
         $item = Item::find($id);
         $item->title = $request->item_title;
         $item->price = $request->item_price;
         $item->store_quantity = $request->item_store_quantity;

         $menu = Menu::where('name_menu', $request->item_menu)->firstOrFail();
         $item->menu_id = $menu->id; // Assign the menu ID to the menu_id attribute
         $submenu = Submenu::where('submenu_name', $request->item_submenu)->firstOrFail();
         $item->submenu_id = $submenu->id; // Assign the submenu ID to the submenu_id attribute
         $supplier = Supplier::where('name_supplier', $request->item_supplier)->firstOrFail();
         $item->supplier_id = $supplier->id; // Assign the supplier ID to the menu_id attribute

         $item->description = $request->item_description;
         if ($request->file('item_image')) {
             $file = $request->file('item_image');
             $filename = date('YdmHi') . $file->getClientOriginalName();
             $file->move(public_path('upload/item_images'), $filename);
             $item->image = $filename;
         }
         $item->save();
         return redirect()->back()->with("success", "Updated Item successfully!");
     }
     //=====================End Method==========================//

    //===================== Filter Method==========================//

    public function filter_item(Request $request)
    {
        $menuId = $request->query('menu_id');
        $submenuId = $request->query('submenu_id');
        $count = 1;

        $menu = Menu::all();
        $submenu = Submenu::all();
        $item = Item::query();
        
        if ($menuId) {
            $item->where('menu_id', $menuId);
        }
        
        if ($submenuId) {
            $item->where('submenu_id', $submenuId);
        }
        
        $item = $item->get();
    
        return view('seller.home.item.list_item')
        ->with('count', $count)
            ->with('menu', $menu)
            ->with('submenu', $submenu)
            ->with('item', $item)
            ->with('menuId', $menuId)
            ->with('submenuId', $submenuId);
    }
    //===================== End Method ==========================//
    //===================== getSubmenus Method ==========================//

    public function getSubmenus($menuId)
    {
        $submenus = Submenu::where('menu_id', $menuId)->get();
    
        return response()->json(['submenus' => $submenus]);
    }
    
    //===================== End Method ==========================//
  
}