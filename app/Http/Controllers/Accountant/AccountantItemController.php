<?php

namespace App\Http\Controllers\Accountant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Menu;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;


class AccountantItemController extends Controller
{
    //==================Show All Item=======================//
    public function item()
    {
        $item = Item::with('menus')->orderByDesc('id')->get(); // Include the menu relationship
        $menus = Menu::all();
        $count = 1;
       
        return view(
            'accountant.home.item.list_item',
            compact('count', 'item', 'menus')
        );
    }
  


    //==================End Method=======================//

    //==================Create_item=======================//
    public function create_item() {
        $menu = Menu::all();
        $supplier = Supplier::all();
        return view('accountant.home.item.create_item', compact('menu','supplier'));
    }
    //==================End Method=======================//

    //===============Store Create Items========================//
    public function create_itemPost(Request $request)
    {
        $data['title'] = $request->item_title;
        //$data['origin_price'] = $request->item_origin_price;
        $data['price'] = $request->item_price;
        $data['description'] = $request->item_description;
        $data['store_quantity'] = $request->item_store_quantity;
        // Update store_quantity in order_items table
        // Get the newly created item's store_quantity

        


        
        // Retrieve the selected menu
        $menu = Menu::where('name_menu', $request->item_menu)->firstOrFail();
        if ($request->file('item_image')) {
            $file = $request->file('item_image');
            $filename = date('YdmHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/item_images'), $filename);
            $data['image'] = $filename;
        }
        $data['menu_id'] = $menu->id; // Store the menu ID in the items table
        //Retrieve the selected supplier
        $supplier = Supplier::where('name_supplier', $request->item_supplier)->firstOrFail();
        $data['supplier_id'] = $supplier->id; // Store the supplier ID in the items table

        Item::create($data);
        return redirect()->back()->with("success", "Item Created successfully!");
    }
    //=====================End Method==========================//
    //==================Show Update Item Form=======================//
    public function update_item($id)
    {
        $item = Item::where('id',$id)->first();
        $menu = Menu::all();
        $supplier = Supplier::all();
        return view('accountant.home.item.update_item',compact('item','menu','supplier'));
    }
    //=====================End Method==========================//
    //==================Store Update Item =======================//
    public function update_itemPost(Request $request, $id)
    {
        $item = Item::find($id);
        $item->title = $request->item_title;
        $item->price = $request->item_price;
        $item->store_quantity = $request->item_store_quantity;
        // $item->origin_price = $request->item_origin_price;
       
       
        $menu = Menu::where('name_menu', $request->item_menu)->firstOrFail();
        $item->menu_id = $menu->id; // Assign the menu ID to the menu_id attribute
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

    //==================Delete Item=======================//
    public function delete_item($id_item)
    {
        $delete = Item::where('id', $id_item)->first();
        $delete->delete();
        return redirect('/accountant/item')
        ->with("success","Item deleted successfully!");
    }
    //=====================End Method==========================//

    //===================== Filter Method==========================//
    public function filter_item(Request $request)
    {
        $filter = $request->query('filter');
        $count = 1;
        $menu = Menu::all();
        $item = Item::all();
        $query = Item::query(); // Create a base query
        $item = Item::where('title', 'LIKE', "%$filter%")
            ->orWhereHas('menus', function ($query) use ($filter) {
                $query->where('name_menu', 'LIKE', "%$filter%");
            })
            ->orWhere('menu_id', $filter)
            ->get();
        return view('accountant.home.item.list_item')
        ->with('count', $count)
        ->with('menu', $menu)
        ->with('item', $item)
        ->with('filter', $filter);
    
    }
    //=====================End Method==========================//
  
}