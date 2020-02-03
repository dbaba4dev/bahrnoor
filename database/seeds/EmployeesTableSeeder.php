<?php

use App\Employee;
use App\Profile;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee =  Employee::create([
            'name'=>'Yahaya Isa',
            'category_id' => 2,
            'joined' =>Carbon::parse('2/04/2010')->toDateTimeString()
        ]);

        Profile::create([
            'employee_id'=>$employee->id,
            'avatar'=>'uploads/avatars/avatar5.png',
            'address'=>'Bulabulin Ganaram. Maiduguri, Nigeria.',
            'phone'=>'08037524400'
        ]);
    }
}
