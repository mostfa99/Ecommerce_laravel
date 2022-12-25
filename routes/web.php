<?php
use App\Http\Controllers\Admin\CatagoriesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages/welcome');
});

Route::get('/admin/catagories',[CatagoriesController::class,'index'])->name('catagories.index');
Route::get('/admin/catagories/create',[CatagoriesController::class,'create'])->name('catagories.create');
Route::post('/admin/catagories',[CatagoriesController::class,'store'])->name('catagories.store'); //to edit in database we will use post or delete but cant use get
Route::get('admin/catagories/{id}',[CatagoriesController::class, 'show'])->name('catagories.show');
Route::get('admin/catagories/edit/{id}',[CatagoriesController::class, 'edit'])->name('catagories.edit');
Route::put('admin/catagories/{id}',[CatagoriesController::class, 'update'])->name('catagories.update');
Route::delete('admin/catagories/{id}',[CatagoriesController::class, 'destroy'])->name('catagories.destroy');

// Route::resource('/admin/catagories', CatagoriesController::class);

/*

Route::get('/about-me', function () {
    return view('pages/aboute');
});

Route::view('contact-me', 'pages/contact', [
    'page_name'=> 'contact Me page',
    'page_descraption' => 'This is Descraption'
        ]);

Route::get('catagory/{id}', function ($id = null) {
    $cats = [
    '1' =>'games',
    '2' =>'Programming',
    '3' =>'Books',
        ];

    return view('pages/catagory' , [
        'the_id' =>$cats[$id] ?? "THIS ID IS NOT FOUND  "
    ]) ;

    });

    */