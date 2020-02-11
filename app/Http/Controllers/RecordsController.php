<?php

namespace App\Http\Controllers;

use App\Bag;
use App\Customer;
use App\Employee;
use App\Order;
use App\Setting;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class RecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        $customers = Customer::all();
        $orders = Order::all();
        $bags = Bag::all();
        return view('admin.transactions.record', compact('employees', 'customers', 'orders', 'bags'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $price = Setting::first()->bag_price;
        $amount_exp=[];
        $amount_val = 0;
        $amount_exp_val = 0;
        $balance=[];
        foreach ($request->hidden_bags as $bag)
        {
            $amount_exp[] = $bag*$price;
        }

        $n = sizeof($amount_exp);
        for ($i =0; $i<$n; ++$i)
        {
            $amount_val=  $request->hidden_amounts[$i];
            $amount_exp_val = $amount_exp[$i];
            $balance[]=$amount_exp_val - $amount_val;
        }


        $length = $request->lengths;
        $height = $request->heights;
        $width = $request->widths;
        $plus = $request->pluses;

        $order = Order::create([
            'employee_id'=>$request->employee_id,
            'user_id'=>Auth::user()->id,
            'plus'=>$plus,
            'width'=>$width,
            'height'=>$height,
            'length'=>$length
        ]);

        $order_id=$order->id;
        $customer_id=$request->hidden_customers;
        $bags_sold=$request->hidden_bags;
        $damages=$request->hidden_damages;
        $amount_paid=$request->hidden_amounts;
        $description=$request->hidden_description;

        if (count($customer_id)>0)
        {
            foreach ($customer_id as $key=>$id)
            {
                $data = array(
                    'order_id' => $order_id,
                'customer_id' => $id,
                'bags_sold' => $bags_sold[$key],
                'damages' => $damages[$key],
                'amount_paid' => $amount_paid[$key],
                'amount_exp' =>$amount_exp[$key],
                'balance' => $balance[$key],
                'description' => $description[$key]
                );

                Bag::create($data);
            }
            $notification = array(
                'message' => 'Record updated successfully!',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }



//     die();



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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
