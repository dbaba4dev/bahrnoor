<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
//        dd($request->all());die();
        $this->validate($request, [
            'name'=>'required|unique:users',
            'email'=>'required|unique:users,email'
        ]);

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt('password')
        ]);

        $profile = Profile::create([
            'user_id'=>$user->id,
            'avatar'=>'uploads/avatars/avatar5.png'
        ]);


        $notification = array(
            'message' => 'User created successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('users')->with($notification);

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
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'=>'required',
            'email'=>'required|email',
            'address'=>'required',
            'phone'=>'required'

        ]);

        $user = User::findOrFail($id);

        if ($request->hasFile('avatar'))
        {
            $image = $request->avatar;
            $new_image_name = time().$image->getClientOriginalName();
            $image->move('uploads/avatars', $new_image_name);
            $user->profile->avatar = 'uploads/avatars/'.$new_image_name;
        }

        $user->name=$request->name;
        $user->email=$request->email;
        $user->profile->address=$request->address;
        $user->profile->phone=$request->phone;

        $user->profile->save();

        if ($request->has('password'))
        {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        $notification = array(
            'message' => 'User Account updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('users')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->profile->delete();
        $user->delete();

        $notification = array(
            'message' => 'User account deactivated',
            'alert-type' => 'warning'
        );

        return redirect()->route('users')->with($notification);
    }

    public function is_admin($id)
    {
        $user = User::findOrFail($id);
        $user->admin = 0;

        $user->save();

        $notification = array(
            'message' => 'User permissions changed.',
            'alert-type' => 'success'
        );

        return redirect()->route('users')->with($notification);
    }

    public function not_admin($id)
    {
        $user = User::findOrFail($id);
        $user->admin = 1;

        $user->save();

        $notification = array(
            'message' => 'User permissions changed.',
            'alert-type' => 'success'
        );

        return redirect()->route('users')->with($notification);
    }

    public function trashes()
    {
        $users = User::onlyTrashed()->get();
        $profile=Profile::onlyTrashed()->get();
        return view('admin.users.deactivated', compact('users','profile'));
    }

    public function restore($id)
    {
        $user = User::where('id',$id)->onlyTrashed()->first();
        $profile =Profile::where('user_id',$id)->onlyTrashed()->first();

        $user->restore();
        $profile->restore();

        $notification = array(
            'message' => 'User account re-activated!!',
            'alert-type' => 'success'
        );

        return redirect()->route('users')->with($notification);
    }

    public function delete($id)
    {
        $user = User::where('id',$id)->onlyTrashed()->first();
        $profile = Profile::where('user_id',$id)->onlyTrashed()->first();

        $profile->forceDelete();
        $user->forceDelete();

        $notification = array(
            'message' => 'User account is permanently deleted.',
            'alert-type' => 'error'
        );

        return redirect()->route('users')->with($notification);
    }
}
