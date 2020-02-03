<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $p1 =  [
            'name'=>'Management',
       ];
        $p2 =  [
            'name'=>'Driver',
        ];
        $p3 =  [
            'name'=>'Packer',
        ];
        $p4 =  [
            'name'=>'Supplier',
        ];



        Category::create($p1);
        Category::create($p2);
        Category::create($p3);
        Category::create($p4);
    }
}
