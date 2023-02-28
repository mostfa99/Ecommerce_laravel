<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Product;
use App\Models\User;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::join('categories', 'categories.id', '=', 'products.category_id')
            ->select([
                'products.*',
                'categories.name as category_name',
            ])->latest()->limit(10)->get();
        return view('home', [
            'products' => $products,
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
