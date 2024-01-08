<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Cart;
use App\Models\Menu;
use App\Models\Submenu;



class HomeController extends Controller
{
    //================Home==================//
    public function home()
    {
        $item = Item::paginate(9);
        $user_id = Auth::id();
        $count = Cart::where('user_id',$user_id)->count();
        $menu = Menu::all();
        return view('user.index',compact('item','count','menu'));
    }
    //================End Method==================//

    //================Menu==================//
    public function menu()
    {
        $item = Item::paginate(9);
        $user_id = Auth::id();
        $count = Cart::where('user_id',$user_id)->count();
        $menu = Menu::all();
        $submenu = Submenu::all();
        return view('user.home.subpages.menu',compact('item','count','menu','submenu'));
    }
    //================End Method==================//
    //================Start showSubmenuItem==================//
      public function showSubmenuItems($submenuId)
      {
          $user_id = Auth::id();
          $count = Cart::where('user_id',$user_id)->count();
          $submenu = Submenu::all();
          $menu = Menu::all();
          $item = Item::where('submenu_id', $submenuId)->paginate(9);
          
          return view('user.home.subpages.submenu_items', compact('count','item','submenu','menu'));
      }
    //================About==================//
    public function about()
    {
        $user_id = Auth::id();
        $count = Cart::where('user_id',$user_id)->count();
        return view('user.home.subpages.about',compact('count'));
    }
    //================End Method==================//


    //================Search Item==================//   
    public function search(Request $request)
    {
        $user_id = Auth::id();
        $count = Cart::where('user_id', $user_id)->count();
        $menu = Menu::all();
        $search_text = $request->search;
        $item = Item::where('title', 'LIKE', "%$search_text%") // Filters items where the title is similar to the search text
            ->orWhereHas('menus', function ($query) use ($search_text) {
                $query->where('name_menu', 'LIKE', "%$search_text%"); // Filters items by related menu names
            })
            ->orWhereHas('submenus', function ($query) use ($search_text) {
                $query->where('submenu_name', 'LIKE', "%$search_text%"); // Filters items by related submenu names
            })
            ->paginate(9);
        return view('user.home.subpages.menu', compact('item', 'count', 'menu'));
    }
    
}

