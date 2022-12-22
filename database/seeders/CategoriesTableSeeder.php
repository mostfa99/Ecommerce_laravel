<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
// way 1
    //     Category::create([
    //     'name' => 'Category model',
    //     'slug' => 'categories-model',
    //     'status' => 'active',
    // ]);
    //     return ;
// way 2
    //     for($i=1; $i<=10;$i++){
    //     DB::table('categories')->insert([
    //         'name' => 'Category '.$i,
    //         'slug' => 'my-first-categories'.$i,
    //         'status' => 'active',
    //     ]);
    //  }
    }
}
