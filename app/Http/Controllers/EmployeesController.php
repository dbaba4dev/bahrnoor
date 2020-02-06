<?php

namespace App\Http\Controllers;

use App\Category;
use App\Employee;
use App\Profile;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::paginate(5);

//        $employee = Employee::find(1);
//        dd($employee->profile->avatar);
        return view('admin.employees.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all();

        $categories = Category::all();

        return view('admin.employees.create',compact('employees','categories'));
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
//        dd($request->all());
        $this->validate($request, [
            'name'=>'required|unique:employees',
            'phone'=>'required',
            'joined'=>'required',
            'category_id'=>'required',
            'address'=>'required',
            'avatar'=>'required|image'
        ]);

        $employee = Employee::create([
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            'joined'=>Carbon::parse($request->joined)->format('Y-m-d H:i:s'),
        ]);

        $avatar = '';

        if ($request->hasFile('avatar'))
        {
            $image = $request->avatar;
            $new_image_name = time().$image->getClientOriginalName();
            $image->move('uploads/employees/images', $new_image_name);
            $avatar = 'uploads/employees/images/'.$new_image_name;
        }


        $profile = Profile::create([
            'employee_id'=>$employee->id,
            'avatar'=>$avatar,
            'address'=>$request->address,
            'phone'=>$request->phone
        ]);

//        $employee->customers()->attach($request->customers());

        $notification = array(
            'message' => 'Employee created successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('employees')->with($notification);


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

        $employee = Employee::findOrFail($id);
        $categories =Category::all();

        return view('admin.employees.edit',compact('employee', 'categories'));

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
//        dd('ddddd');die();
        $this->validate($request, [
            'name'=>'required',
            'phone'=>'required',
            'joined'=>'required',
            'category_id'=>'required',
            'address'=>'required'

        ]);

        $employee = Employee::findOrFail($id);



        if ($request->hasFile('avatar'))
        {
            $image = $request->avatar;
            $new_image_name = time().$image->getClientOriginalName();
            $image->move('uploads/employees/images', $new_image_name);
            $employee->profile->avatar = 'uploads/employees/images/'.$new_image_name;
        }

        $employee->name=$request->name;
        $employee->category_id=$request->category_id;
        $employee->joined=$request->joined;

        $employee->profile->employee_id=$id;
        $employee->profile->address=$request->address;
        $employee->profile->phone=$request->phone;

        $employee->save();

        $employee->profile->save();

        $notification = array(
            'message' => 'Employee details updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('employees')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->profile->delete();
        $employee->delete();

        $notification = array(
            'message' => 'Employee information trashed!',
            'alert-type' => 'warning'
        );

        return redirect()->route('employees')->with($notification);
    }

    public function trashes()
    {
        $employees = Employee::onlyTrashed()->get();
        $profiles = Profile::onlyTrashed()->get();
        return view('admin.employees.trashes', compact('employees','profiles'));
    }

    public function restore($id)
    {
        $employee=Employee::where('id',$id)->onlyTrashed()->first();
        $profile=Profile::where('employee_id',$id)->onlyTrashed()->first();

        $employee->restore();
        $profile->restore();

        $notification = array(
            'message' => 'Employee information Restored!',
            'alert-type' => 'info'
        );

        return redirect()->route('employees')->with($notification);
    }

    public function delete($id)
    {
        $employee=Employee::where('id',$id)->onlyTrashed()->first();
        $profile=Profile::where('employee_id',$id)->onlyTrashed()->first();

        $employee->forceDelete();
        $profile->forceDelete();

        $notification = array(
            'message' => 'Employee Details are permanently deleted.',
            'alert-type' => 'error'
        );

        return redirect()->route('employees')->with($notification);
    }

}
