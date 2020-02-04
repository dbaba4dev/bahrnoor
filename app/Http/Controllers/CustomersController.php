<?php

namespace App\Http\Controllers;

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
        return view('admin.customers.index');
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
        $customers=Customer::all();
        return view('admin.customers.create',compact('customers'));
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
        $this->validate($request,[
            'name'=>'required|unique:customers',
            'area_id'=>'required',
            'employee_id'=>'required',
            'credit_limit'=>'required'
        ]);

        $customer = Customer::create([
            'name'=>$request->name,
            'area_id'=>$request->area_id,
            'employee_id'=>$request->employee_id,
            'credit_limit'=>$request->credit_limit,
            'balance'=>$request->balance
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
        return view('admin.customers.edit',compact('customer'));
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
            'name'=>'required|unique:customers',
            'area_id'=>'required',
            'employee_id'=>'required',
            'credit_limit'=>'required',
            'balance'=>'required'

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
        $customer->balance=$request->balance;

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
        $customer->delete();

        $notification = array(
            'message' => 'Customer record delete successfully!',
            'alert-type' => 'error'
        );

        return redirect()->route('customers')->with($notification);
    }
}
