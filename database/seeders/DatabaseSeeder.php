<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(4)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //Category::factory(10)->create();
        Product::factory(50)->create();
        //Admin::factory(5)->create();

        $this->call([
            //CategoriesTableSeeder::class,
            //ProductTableSeeder::class,
            //UsersTableSeeder::class,
        ]);
    }
}
