<?php

namespace App\Http\Controllers\Backend;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::latest()->get();
        return view('backend.supplier.index',['suppliers'=>$suppliers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validator = $request->validate([
            'name' => 'required',
            'mobile_no'=>'required',
            'email' => 'required|unique:suppliers',
            'address' => 'required'
       ]);

        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->mobile_no = $request->mobile_no;
        $supplier->email = $request->email;
        $supplier->address = $request->address;
        
        $supplier->save();

        return response()->json([
            'status'=>'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $data = Supplier::find($request->id);

        return response()->json([
            'data'=>$data
        ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request->all());
       
        
        $upSupplier = Supplier::find($request->updateId);

        $upSupplier->name         =   $request->updatename;
        $upSupplier->mobile_no    =   $request->updatemobile_no;
        $upSupplier->email        =   $request->updateemail;
        $upSupplier->address      =   $request->updateaddress;
        $upSupplier->status       =   $request->updateStatus;
       
        $upSupplier->update();

        return response()->json([
            'status'=>'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $upSupplier = Supplier::find($request->id);
        $upSupplier->delete();
        return response()->json([
            'status'=>'success'
        ]);


    }
}
