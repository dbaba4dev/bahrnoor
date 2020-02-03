<?php

use App\Profile;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =  User::create([
            'name'=>'Dauda Baba',
            'email'=>'deebaba4u@gmail.com',
//            'image'=>'uploads/avatars/dbaba.jpg',
            'password'=>bcrypt('funken'),
            'admin'=>1
        ]);

        Profile::create([
            'user_id'=>$user->id,
            'avatar'=>'uploads/avatars/dbaba.jpg',
            'address'=>'36 Ngorgi Street, Hausari Ward. Maiduguri, Nigeria.',
            'phone'=>'08037520000'
        ]);

//        factory(User::class, 5)->create();
    }
}
