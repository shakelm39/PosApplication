<?php

namespace App\Http\Controllers\Backend;

use App\Models\Unit;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allData = Product::all();
        $data['suppliers'] = Supplier::all();
    	$data['brands'] = Brand::all();
    	$data['units'] = Unit::all();
    	$data['categories'] = Category::all();
        return view('backend.product.index',['allData' => $allData],$data);
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
        
            $product = new Product();
            $product->supplier_id = $request->supplier_id;
            $product->brand_id = $request->brand_id;
            $product->unit_id = $request->unit_id;
            $product->category_id = $request->category_id;
            $product->name = $request->name;
            $product->quantity = '0';
            $product->created_by = Auth::user()->id;
            $product->save();
            

        return redirect()->route('products.index')->with('success', 'Product has been successfully added.');
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
    public function edit($id)
    {
        $data['editData'] = Product::find($id);
        
    	$data['suppliers'] = Supplier::all();
    	$data['brands'] = Brand::all();
    	$data['units'] = Unit::all();
    	$data['categories'] = Category::all();

    	return view('backend.product.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product =Product::find($id);
    	$product->supplier_id = $request->supplier_id;
    	$product->brand_id = $request->brand_id;
    	$product->unit_id = $request->unit_id;
    	$product->category_id = $request->category_id;
    	$product->name = $request->name;
    	$product->quantity = '0';
    	$product->updated_by = Auth::user()->id;
    	$product->update();

    	return redirect()->route('products.index')->with('success','Successfully Data Updated !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('products.index')->with('success',"Successfully Data Deleted !!");
            }
}
