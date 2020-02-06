<?php

namespace App\Http\Controllers;

use App\Area;
use App\Customer;
use App\Employee;
use App\Profile;
use App\User;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers=Customer::all();
        $employees=Employee::all();
        $areas=Area::all();

        if (count($areas) == 0)
        {
            $notification = array(
                'message' => 'You must have one or more Customer Area(s) added before creating customer',
                'alert-type' => 'info'
            );

            return redirect()->route('area.create')->with($notification);
        }
        return view('admin.customers.create',compact('customers', 'areas', 'employees'));
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
        $this->validate($request,[
            'name'=>'required|unique:customers',
            'area_id'=>'required',
            'employee_id'=>'required'
        ]);

        $customer = Customer::create([
            'name'=>$request->name,
            'area_id'=>$request->area_id,
            'employee_id'=>$request->employee_id,
            'credit_limit'=>$request->credit_limit
//            'balance'=>$request->balance
        ]);

        $avatar = '';

        if ($request->hasFile('avatar'))
        {
            $image = $request->avatar;
            $new_image_name = time().$image->getClientOriginalName();
            $image->move('uploads/customers/images', $new_image_name);
            $avatar = 'uploads/customers/images/'.$new_image_name;
        }

        $profile = Profile::create([
            'customer_id'=>$customer->id,
            'avatar'=>$avatar,
            'address'=>$request->address,
            'phone'=>$request->phone
        ]);

//        $customer->employees->attach($request->employees);

        $notification = array(
            'message' => 'Customer created successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('customers')->with($notification);
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
        $customer=Customer::findOrFail($id);
        $employees=Employee::all();
        $areas=Area::all();

        return view('admin.customers.edit',compact('customer', 'employees','areas'));
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
            'area_id'=>'required',
            'employee_id'=>'required'

        ]);

        $customer = Customer::findOrFail($id);

        if ($request->hasFile('avatar'))
        {
            $image = $request->avatar;
            $new_image_name = time().$image->getClientOriginalName();
            $image->move('uploads/customers/images', $new_image_name);
            $customer->profile->avatar = 'uploads/customers/images/'.$new_image_name;
        }

        $customer->name=$request->name;
        $customer->area_id=$request->area_id;
        $customer->employee_id=$request->employee_id;
        $customer->credit_limit=$request->credit_limit;

        $customer->profile->customer_id=$id;
        $customer->profile->address=$request->address;
        $customer->profile->phone=$request->phone;

        $customer->save();

        $customer->profile->save();

        $notification = array(
            'message' => 'Customer record updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('customers')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->profile->delete();
        $customer->delete();

        $notification = array(
            'message' => 'Customer record deleted and backup in trashed can.',
            'alert-type' => 'warning'
        );

        return redirect()->route('customers')->with($notification);
    }

    public function trashes()
    {
        $customers = Customer::onlyTrashed()->get();
        $profiles = Profile::onlyTrashed()->get();
        return view('admin.customers.trashes', compact('customers','profiles'));
    }

    public function restore($id)
    {
        $customer = Customer::where('id',$id)->onlyTrashed()->first();
        $profile=Profile::where('customer_id',$id)->onlyTrashed()->first();

        $customer->restore();
        $profile->restore();

        $notification = array(
            'message' => 'Customer record restored!!',
            'alert-type' => 'success'
        );

        return redirect()->route('customers')->with($notification);
    }

    public function delete($id)
    {
        $customer = Customer::where('id',$id)->onlyTrashed()->first();
        $profile=Profile::where('customer_id',$id)->onlyTrashed()->first();


        $profile->forceDelete();
        $customer->forceDelete();

        $notification = array(
            'message' => 'Permanently deleted Customer record!!',
            'alert-type' => 'error'
        );

        return redirect()->route('customers')->with($notification);
    }


}
