<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Setting::create([
            'site_name' =>"Bahrnoor's Water",
            'contact_address' =>"Maiduguri, Borno State",
            'contact_number' =>"08022775600",
            'contact_email' =>"info@bahrnoor.com",
            'bag_price' =>45
        ]);
    }
}
