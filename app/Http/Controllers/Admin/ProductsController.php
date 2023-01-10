<?php

namespace App\Http\Controllers\Admin;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
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
        //return collection of model catagory
        $products = Product::join('categories','categories.id','=','products.category_id')
        ->select([
            'products.*',
            'categories.name as category_name',
        ])
        ->latest()
        ->paginate(15,['*'],'p');
        // ->simplePaginate();
        // ->paginate( limit of entries , ['*'] , name page , defult apge );


        $title ='products List';

        // $success = session()->get('success');
        return view('admin.products.index', [
            'products'=> $products,
            'title'=> $title,
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
        $categories = Category::pluck('name' , 'id');

        return view('admin.products.create',[
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
            'slug'=>Str::slug($request->post('name'))
        ]);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $image_path = $file->store('/',[
                'disk'=> 'uploads'
            ]);
            $request->merge([
                'image_path' =>$image_path,
            ]);
        }

        $product = Product::create($request->all());

        return redirect()->route('products.index')
        ->with('success',"Product($product->name) Created.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product =Product::findOrFail($id);
        return view('admin.products.show',[
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
        $product =Product::findOrFail($id);
        return view('admin.products.edit',[
            'product' => $product,
            'categories'=> Category::withTrashed()->pluck('name' , 'id'),

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
        $request->validate(Product::validateRules());
        if($request->hasFile('image')){
            $file = $request->file('image');
            $image_path = $file->store('/',[
                'disk'=> 'uploads'
            ]);
            $request->merge([
                'image_path' =>$image_path,
            ]);
        }
        $product->update($request->all());

        return redirect()->route('products.index')
        ->with('success',"Product($product->name) Updated! ");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        Product::destroy($id);

        // Storage::disk('uploads')->delete($product->image_path);
        // unlink(public_path('uploads/' . $product->image_path));

        return redirect()->route('products.index')
        ->with('success',"Product($product->name) Deleted! ");

    }

    public function trash(){

        $products = Product::onlyTrashed()->paginate();
        return view('admin.products.trash',[
            'products'=> $products
        ]);
    }

    public function restore(Request $request, $id =null){
        if($id){
            $product=Product::onlyTrashed()->findOrfail($id);
            $product->restore();
            return redirect()->route('products.index')
            ->with('success',"Product($product->name) Restored! ");
        }
            Product::onlyTrashed()->restore();
            return redirect()->route('products.index')
            ->with('success',"All Trashed Products Restored. ");


    }
    public function forceDelete($id=null){

        if($id){
            $product=Product::onlyTrashed()->findOrfail($id);
            $product->forceDelete();
            return redirect()->route('products.index')
            ->with('success',"Product($product->name) delete forever! ");
        }
            Product::onlyTrashed()->forceDelete();
            return redirect()->route('products.index')
            ->with('success',"All Trashed Products delete forever. ");


        }

}
