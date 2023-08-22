<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['allData'] = User::all();
   	    return view('backend.user.index',$data);
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
        
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|unique:users,email'
        ]);
        $data = new User();
        $data->usertype = $request->usertype;
        $data->name 	= $request->name;
        $data->email 	= $request->email;
        $data->password = bcrypt($request->password);
        $data->save();

        
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
        $user  = User::findOrFail($request->id);

        return response()->json([
            'user'=>$user,
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
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$request->userUpId,
        ]);

        $data = User::find($request->userUpId);
        $data->usertype = $request->usertype;
        $data->name    = $request->name;
        $data->email   = $request->email;
        $data->status   = $request->status;
        $data->save();

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
    public function delete(Request $request)
    {
        $user  = User::findOrFail($request->id);
        $user->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }
}
