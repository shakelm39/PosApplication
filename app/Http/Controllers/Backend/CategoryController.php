<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('backend.category.index',compact('categories'));
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
            'name' =>'required|unique:categories',
        ],
        [
            'name.required' => 'Categories name missing',
            
        ]);

        $category = new Category();
        $category->name=$request->name;

        $category->save();

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
        

        $category = Category::find($request->catEditId);
        
        return response()->json([
            'category'=>$category,
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
        $request->validate([
            'update_name' =>'required|unique:categories,name,'.$request->cat_update_id,
        ],
        [
            'update_name.required' => 'Categories name missing',
            'update_name.unique' => 'Categories already exists'
            
        ]);

        $category = Category::find($request->cat_update_id);
        $category->name = $request->update_name;
        $category->status = $request->update_status;
        $category->update();

        return response()->json([
            'status'=>'success',
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
        //dd($request->all());
        $category = Category::find($request->catDelId);
        $category->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
}
