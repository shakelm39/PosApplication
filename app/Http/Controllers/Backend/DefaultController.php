<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DefaultController extends Controller
{
    public function getCategory(Request $request){
    	$supplier_id = $request->supplier_id;
    	$allCategory = Product::with(['category'])->select('category_id')->where('supplier_id',$supplier_id)->groupBy('category_id')->get();
    	return response()->json($allCategory);
    }
    public function getBrand(Request $request){
    	$product_id = $request->product_id;
        $allBrand = Product::with(['brand'])->select('brand_id')->where('id',$product_id)->groupBy('brand_id')->get();
        return response()->json($allBrand);
    }
    
    public function getProduct(Request $request){
        $category_id = $request->category_id;
        $allProduct = Product::where('category_id',$category_id)->get();
        return response()->json($allProduct);
    } 
    public function getStock(Request $request){

        $product_id = $request->product_id;
        $allStock = Product::where('id',$product_id)->first()->quantity;
        return response()->json($allStock);
    }
}
