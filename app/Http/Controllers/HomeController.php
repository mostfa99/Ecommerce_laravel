<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        /*$request = request();
        $query = Product::query();
        if ($name = $request->query('name')) {
            $query->where('name', 'LIKE', "%{$name}%");
        }
        if ($status = $request->query('categories')) {
            $query->where('categories', 'LIKE', "%{$status}%");
        }
        $products =  $query->WithoutGlobalScopes([ActiveStatusScope::class])
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->with('category.parent')
            ->select([
                'products.*',
                // 'categories.name as category_name',
            ]);*/

        $categories = Category::with('parent')
            ->withCount('products')
            ->paginate(5);

        /*$products = Product::join('categories', 'categories.id', '=', 'products.category_id')
            ->select([
                'products.*',
                'categories.name as category_name',
            ])->latest()->limit(10)->get();*/
        $products = Product::all();
        return view('home', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function getUser()
    {
        $users = User::with(['profile', 'country'])->get();
        echo '<h2>User details </h2>' . '<br>';
        foreach ($users as $user) {
            echo '<p><ul>';
            echo '<li>' . $user->name;
            if ($user->profile) {
                echo ' ==> ' . $user->profile->address;
            }
            if ($user->country) {
                echo ' + ' . $user->country->name;
            }
            echo '</li>';
            echo '</ul></p>';
        }

        $admins = Admin::get();
        echo '<h2>Admins details </h2>' . '<br>';
        foreach ($admins as $admin) {
            echo '<p>';
            echo $admin->name . '==>';
            echo $admin->email . '<br>';
            echo '</p>';
        }
    }
}
