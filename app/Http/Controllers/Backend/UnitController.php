<?php

namespace App\Http\Controllers\Backend;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::latest()->get();
        return view('backend.unit.index',['units' => $units]);
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
        //dd($request->all());

        $request->validate([
            'name'=>'required|unique:units',
        ],[
            'name.required'=>'Unit Name required',
            'name.unique'=>'Unit Name already exists'
        ]);

        $unit = new Unit();
        $unit->name = $request->name;
        $unit->save();

        return response()->json([
            'status'=>'success',
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
        $unit = Unit::findOrfail($request->id);

        return response()->json([
            'unit'=>$unit,
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
        $unit = Unit::findOrfail($request->unit_update_id);

        $unit->name = $request->unitUpdateName;
        $unit->status = $request->unitUpdateStatus;
        $unit->update();

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
        $unit = Unit::findOrFail($request->id);
        $unit->delete();
        return response()->json([
            'status'=>'success',
        ]);
    }
}
