<?php

namespace Database\Factories;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $product = DB::table('products')
        ->inRandomOrder()
        ->limit(1)
        ->first(['id']);
        $name = $this->faker->words(2,true);
        $status = ['active','draft'];

        return [
        'name'=> $this->faker->words(2,true),//we use true to return vlaue as string without true will return as arry
        'slug'=> Str::slug($name) ,
        'perant_id'=> $product? $product->id :null,
        'descraption'=> $this->faker->words(200,true),
        'image_path'=> $this->faker->imageUrl(),
        'status'=> $status[rand(0,1)] ,
        ];
    }
}