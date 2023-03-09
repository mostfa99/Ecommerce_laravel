<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->authorize('view-any', Product::class);

        // if(!Gate::allows('products.create')){
        //     abort(403);
        // };
        //return collection of model catagory
        $products = Product::WithoutGlobalScopes([ActiveStatusScope::class])
            // ->join('categories','categories.id','=','products.category_id')
            ->with('category.parent')
            ->select([
                'products.*',
                // 'categories.name as category_name',
            ])
            ->latest()
            ->paginate(15, ['*'], 'p');
        // ->simplePaginate();
        // ->paginate( limit of entries , ['*'] , name page , defult apge );


        $title = 'products List';

        // $success = session()->get('success');
        return view('admin.products.index', [
            'products' => $products,
            'title' => $title,
            // 'success'=>$success,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Product::class);

        $categories = Category::pluck('name', 'id');

        return view('admin.products.create', [
            'categories' => $categories,
            'product' => new Product(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Product::validateRules());
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image_path = $file->store('/', [
                'disk' => 'product_images'
            ]);
            $request->merge([
                'image_path' => $image_path,
            ]);
        }

        $product = Product::create($request->all());

        return redirect()->route('products.index')
            ->with('success', "Product($product->name) Created.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::withoutGlobalScopes()->findOrFail($id);
        // SELECT * FROM rating WHERE rateable_id = ? 5 AND rateable_type = 'App\Models\Product'

        return $product->ratings;

        $this->authorize('view', $product);

        return view('admin.products.show', [
            'product' => $product,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // category ::where ('id','=','$id)->first();
        $product = Product::findOrFail($id);
        $this->authorize('update', $product);

        $this->authorize('create', Product::class);
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => Category::withTrashed()->pluck('name', 'id'),

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('update', $product);

        $request->validate(Product::validateRules());
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image_path = $file->store('/', [
                'disk' => 'product_images'
            ]);
            $request->merge([
                'image_path' => $image_path,
            ]);
        }
        $product->update($request->all());

        return redirect()->route('products.index')
            ->with('success', "Product($product->name) Updated! ");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        // Gate::authorize('products.delete');
        $product = Product::findOrFail($id);
        $this->authorize('delete', $product);

        Product::destroy($id);

        // Storage::disk('uploads')->delete($product->image_path);
        // unlink(public_path('uploads/' . $product->image_path));

        return redirect()->route('products.index')
            ->with('success', "Product($product->name) Deleted! ");
    }

    public function trash()
    {

        $products = Product::onlyTrashed()->paginate();
        return view('admin.products.trash', [
            'products' => $products
        ]);
    }

    public function restore(Request $request, $id = null)
    {
        if ($id) {
            $product = Product::onlyTrashed()->findOrfail($id);
            $product->restore();
            return redirect()->route('products.index')
                ->with('success', "Product($product->name) Restored! ");
        }
        Product::onlyTrashed()->restore();
        return redirect()->route('products.index')
            ->with('success', "All Trashed Products Restored. ");
    }
    public function forceDelete($id = null)
    {

        if ($id) {
            $product = Product::onlyTrashed()->findOrfail($id);
            $product->forceDelete();
            return redirect()->route('products.index')
                ->with('success', "Product($product->name) delete forever! ");
        }
        Product::onlyTrashed()->forceDelete();
        return redirect()->route('products.index')
            ->with('success', "All Trashed Products delete forever. ");
    }
}
