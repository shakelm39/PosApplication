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
        $request->validate([
            'name' =>['required','unique:units']
        ],
        [
            'name.required' =>'Unit Name is required',
            'name.unique' =>'Unit name already exists'
        ]);

        $unit = new Unit();
        $unit->name= $request->name;
        $unit->save();
        return redirect()->back()->with('success','Unit saved successfully');
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
        $unit = Unit:: find($id);

        return view('backend.unit.edit',['unit' => $unit]);
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
            'name' =>['required','unique:units,name,'.$request->id,]
        ],
        [
            'name.required' =>'Unit Name is required',
            'name.unique' =>'Unit name already exists'
        ]);

        $unit = Unit::find($request->id);
        $unit->name= $request->name;
        $unit->update();
        return redirect()->route('units.index')->with('success','Unit updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit = Unit::find($id);
        $unit->delete();
        return redirect()->back()->with('success', 'Data deleted successfully');
    }
}
