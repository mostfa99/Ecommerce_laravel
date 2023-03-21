<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\CatagoriesController;
use App\Http\Controllers\Admin\CountriesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NotificationsController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\TwoFactorAuthentcationContoller;
use App\Http\Controllers\Admin\TwoFactorChallangeController;
use App\Http\Controllers\Admin\UserProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Front\PaymentsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\RatingController;
use App\Http\Middleware\CheckUserType;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\WishlistController;
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
/*
// /login
require __DIR__ . '/auth.php';

// admin/login
Route::prefix('admin')
    // ->middleware(['auth:admin'])
    ->namespace('Admin')
    ->as('admin.')
    ->group(function () {
        require __DIR__ . '/auth.php';
    });*/

// Web Route
//
// namespace =>     App/Admin
// prefix    =>     controller/admin

Route::namespace('Admin')
    ->prefix('admin')
    ->middleware(['auth', 'auth.type:admin,super-admin'])
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Orders
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
        Route::get('/trash', [OrderController::class, 'trash'])->name('orders.trash');
        Route::put('/restore/{id?}', [OrderController::class, 'restore'])->name('orders.restore');
        Route::get('/trash/{id?}', [OrderController::class, 'forceDelete'])->name('orders.force-delete');

        // USER
        Route::get('/user-profile', [UserProfileController::class, 'index'])->name('profile');
        Route::get('/2fa', [TwoFactorAuthentcationContoller::class, 'index'])->name('2fa');
        Route::get('notifications', [NotificationsController::class, 'index'])->name('notifications');
        Route::get('notifications/{id}', [NotificationsController::class, 'show'])->name('notifications.read');
        Route::get('/get-user', [HomeController::class, 'getUser'])->name('getUser');
        Route::get('/get-admin', [HomeController::class, 'getAdmin'])
            ->middleware(['auth', 'auth.type:super-admin'])
            ->name('getAdmin');

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
            Route::get('/export', [ProductsController::class, 'export'])->name('export');

            Route::get('/import', [ProductsController::class, 'importView'])
                ->name('import');

            Route::post('/import', [ProductsController::class, 'import']);
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
})->middleware(['auth:web', 'verified'])
    ->name('dashboard');

// product front
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.details');

Route::get('/Categories', [CategoryController::class, 'index'])->name('Category');
Route::post('/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart', [CartController::class, 'store']);

Route::get('/checkout', [CheckoutController::class, 'create'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store']);

Route::get('orders/{order}/pay', [PaymentsController::class, 'create'])
    ->name('order.payments.create');

Route::post('orders/{order}/stripe/payment-intent', [PaymentsController::class, 'createStripePaymentIntent'])
    ->name('stripe.PaymentIntent.create');

Route::get('orders/{order}/pay/stripe/callback', [PaymentsController::class, 'confirm'])
    ->name('stripe.return');

Route::get('/orders', function () {
    return Order::all();
})->name('orders');

Route::get('chat', [MessagesController::class, 'index'])->name('chat');
Route::post('chat', [MessagesController::class, 'store']);

Route::post('/wishlist/add/{product}', [WishlistController::class, 'add'])->name('wishlist.add');
Route::get('/wishlist', [WishlistController::class, 'show'])->name('wishlist.show');
Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])
    ->name('wishlist.destroy');
Route::get('/compare', [CompareController::class, 'index'])->name('compare.index');

Route::get('/categories', [CategoryController::class, 'index'])->name('front.catagories.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('front.catagories.show');

Route::get('/my-account', [AccountController::class, 'index'])->name('account');

Route::delete('/cart/{id}', [CartController::class, 'destroy'])
    ->name('cart.destroy');
