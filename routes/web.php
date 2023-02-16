<?php

use App\Http\Controllers\Admin\CatagoriesController;
use App\Http\Controllers\Admin\CountriesController;
use App\Http\Controllers\Admin\NotificationsController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\RatingController;
use App\Http\Middleware\CheckUserType;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------

| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__ . '/auth.php';

// Web Route
//
// namespace =>     App/Admin
// prefix    =>     controller/admin

Route::namespace('Admin')
    ->prefix('admin')
    ->middleware(['auth', 'auth.type:admin,super-admin'])
    ->group(function () {

        Route::get('notifications', [NotificationsController::class, 'index'])->name('notifications');
        Route::get('notifications/{id}', [NotificationsController::class, 'show'])->name('notifications.read');
        // Product Route
        Route::group([
            'prefix' => '/products',
            'as' => 'products.'
        ], function () {
            Route::get('/trash', [ProductsController::class, 'trash'])
                ->name('trash');
            Route::put('products/restore/{id?}', [ProductsController::class, 'restore'])
                ->name('restore');
            Route::delete('trash/{id?}', [ProductsController::class, 'forceDelete'])
                ->name('force-delete');
        });
        // catagories Route
        Route::group([
            'prefix' => '/catagories',
            'as' => 'catagories.'
        ], function () {
            // Route::resource('/catagories', CatagoriesController::class);

            Route::get('create', [CatagoriesController::class, 'create'])
                ->name('create');
            Route::post('catagories', [CatagoriesController::class, 'store'])
                ->name('store'); //to edit in database we will use post or delete but cant use get
            Route::get('/{category}', [CatagoriesController::class, 'show'])
                ->name('show');
            Route::get('/edit/{id}', [CatagoriesController::class, 'edit'])
                ->name('edit');
            Route::put('/{id}', [CatagoriesController::class, 'update'])
                ->name('update');
            Route::delete('/{id}', [CatagoriesController::class, 'destroy'])
                ->name('destroy');
            Route::get('', [CatagoriesController::class, 'index'])
                ->name('index');
        });

        Route::get('get-user', [HomeController::class, 'getUser']);
    });

Route::resource('admin/products', ProductsController::class)
    ->middleware(['auth', 'auth.type:admin,super-admin']);

Route::resource('admin/roles', RolesController::class)
    ->middleware(['auth', 'auth.type:admin,super-admin']);

Route::resource('admin/countries', CountriesController::class)
    ->middleware(['auth', 'auth.type:admin,super-admin']);

Route::post('ratings/{type}', [RatingController::class, 'store'])
    ->where('type', 'product|profile');

Route::get('profile/{profile}', [ProfileController::class, 'show']);

// homePage
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// product front
Route::get('/products', [ProductController::class, 'index'])->name('products');

Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.details');


Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart', [CartController::class, 'store']);

Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store']);

Route::get('/orders', function () {
    return Order::all();
})->name('orders');
Route::get('chat', [MessagesController::class, 'index'])->name('chat');
Route::post('chat', [MessagesController::class, 'store']);
