<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('admin.settings.settings', compact('setting'));
    }

    public function update_info(Request $request)
    {
        $settings = Setting::first();
        $settings->site_name = $request->site_name;
        $settings->contact_number = $request->contact_number;
        $settings->contact_email = $request->contact_email;
        $settings->contact_address = $request->contact_address;

        $settings->save();

        $notification = array(
            'message' => 'Settings updated successfully!!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function update_price(Request $request)
    {
//        dd($request->all());
        $settings = Setting::first();
        $settings->bag_price = $request->bag_price;

        $settings->save();

        $notification = array(
            'message' => 'Bag price updated successfully!!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
