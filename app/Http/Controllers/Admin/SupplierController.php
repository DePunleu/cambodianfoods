<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Supplier;

class SupplierController extends Controller
{
    //==================Show All Supplier=======================//
    public function supplier() {
        $supplier = Supplier::orderByDesc('id')->get();
        $count = 1;
        return view(
            'admin.home.supplier.list_supplier',
            compact(
                'count',
                'supplier'
            )
        );
    }
    //==================End Method=======================//

    //==================Show Create Supplier Form=======================//
    public function create_supplier() {
        return view('admin.home.supplier.create_supplier');
    }
    //==================End Method=======================//

    //==================Store Create Supplier =======================//
    public function create_supplierPost(Request $request) {
        $request->validate([
            'supplier_name' => [
                'required',
                Rule::unique('suppliers', 'name_supplier'),
            ],
            'supplier_name' => 'required',
            'supplier_description' => 'required',
        ]);
        $data['name_supplier'] = $request -> supplier_name;
        $data['description'] = $request -> supplier_description;
        Supplier::create($data);
        return redirect()->back()->with("success","Supplier Created success!");
    }

    //==================End Method=======================//
    //==================Show Update Supplier Form =======================//

    public function update_supplier($id)
    {
        $supplier = Supplier::where('id',$id)->first();
        return view('admin.home.supplier.update_supplier',['supplier'=>$supplier]);

    }
    //==================End Method=======================//
    //================== Store Update Supplier=======================//
    public function update_supplierPost(Request $request, $id)
    {
        $request->validate([
            'supplier_name' => [
                'required',
                Rule::unique('suppliers', 'name_supplier'),
            ],
            'supplier_description' => 'required',
        ]);
        $supplier = Supplier::find($id);
        $supplier->name_supplier=$request->supplier_name;
        $supplier->description=$request->supplier_description;
        $supplier->save();
        return redirect()->back()->with("success","Updated supplier successfully!");
    }
    //==================End Method=======================//

    //==================Delete Supplier=======================//
    public function delete_supplier($id_supplier) {
        $delete = Supplier::where('id', $id_supplier)->first();
        $delete->delete();
        return redirect('/admin/supplier')
        ->with("success","supplier deleted successfully!");
    }

    //==================End Method=======================//
    
}
