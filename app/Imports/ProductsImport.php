<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    protected $categories;
    public function __construct()
    {
        $this->categories = Category::pluck('id', 'slug')->toArray();
    }
    protected function createCategory($name)
    {
        $category = Category::create([
            'name' => $name,
            'slug' => Str::slug($name),
        ]);
        return $category->id;
    }

    protected function getCategoryId($name)
    {
        $slug = Str::slug($name);
        if (array_key_exists($slug, $this->categories)) {
            return $this->categories[$slug];
        }
        $id = $this->createCategory($name);
        $this->categories[$slug] = $id;
        return $id;
    }

    /**
     * @param array $row
     *
     * @return Product|null
     */
    public function model(array $row)
    {
        //dd($row);
        //     return new Product([
        //         'name' => $row['name'] ?? $row['Name'] ?? $row['product_name'] ?? null,
        //         'category_id' => $this->getCategoryId($row['Category']),
        //         'price' => $row['Price'] ?? $row['price'] ?? $row['Prices'] ?? null,
        //         'status' => $row['status'],
        //     ]);
    }
}
