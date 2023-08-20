<?php

namespace App\Http\Controllers\Backend;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allData = Brand::latest()->get();
        return view('backend.brand.index',['allData'=>$allData]);
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
       
       $request->validate([
        'name' =>'required|unique:brands',
       ],[
        'name.required'=>'Brand Name required',
        'name.unique'=>'Brand name already exists'
       ]); 

       $brand = new Brand();
       $brand->name = $request->name;
       $brand->save();

       return response()->json([
        'status'=>'success',
       ]);

      //return redirect()->route('brands.index')->with('success', 'Brand successfully added');
        
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
        $data = Brand::find($request->brandUpId);
       
        return response()->json([
            'data' => $data,
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
        
        $brand = Brand::find($request->brand_update_id);
        $brand->name = $request->update_name;
        $brand->status = $request->update_status;
        
        $brand->update();

        return response()->json([
            'status' => 'success'
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
        $brand = Brand::find($request->id);

        $brand->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }
}
