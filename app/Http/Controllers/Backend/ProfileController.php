<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $id = Auth::user()->id;
    	$user = User::find($id);
    	return view('backend.user.view-profile',compact('user'));
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
        //
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
    public function edit()
    {
        $id = Auth::user()->id;
		$editData = User::find($id);
		return view('backend.user.edit-profile',compact('editData'));
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
        $data = User::find(Auth::user()->id);
		$data->name = $request->name;
		$data->email = $request->email;
		$data->mobile = $request->mobile;
		$data->address = $request->address;
		$data->gender = $request->gender;
		if ($request->file('image')) {
			$file = $request->file('image');
			@unlink(public_path('upload/user_images/'.$data->image));
			$filename = date('YmdHi').$file->getClientOriginalName();
			$file->move(public_path('upload/user_images'), $filename);
			$data['image'] = $filename;
		}
		$data->save();
		return redirect()->route('profiles.view')->with('success','Profile updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    //Password edit function
	public function passwordView(){
		return view('backend.user.edit-password');
	}

    //password update function
	
	public function passwordUpdate(Request $request){
		if (Auth::attempt(['id'=>Auth::user()->id,'password'=>$request->current_password])) {
			$user = User::find(Auth::user()->id);
			$user->password = bcrypt($request->new_password);
			$user->save();
			return redirect()->route('profiles.view')->with('success','Password Successfully Changed');
		}else{
			return redirect()->back()->with('error','Sorry! Current Password does not Match');
		}
	}
}
