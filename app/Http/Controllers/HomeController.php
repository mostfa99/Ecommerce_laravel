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
        $admins = Admin::get();
        return view('admin.user.index', [
            'users' => $users,
            'admins' => $admins,
        ]);
    }
    public function getAdmin()
    {
        $admins = Admin::get();
        return view('admin.user.getAdmin', [
            'admins' => $admins,
        ]);
    }
}
