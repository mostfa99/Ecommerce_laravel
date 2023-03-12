<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CatagoriesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $request = request();
        $query = Category::query();
        if ($name = $request->query('name')) {
            $query->where('categories.name', 'LIKE', "%{$name}%");
        }
        if ($status = $request->query('status')) {
            $query->where('categories.status', 'LIKE', "%{$status}%");
        }
        //return collection of model catagory
        //$categories = Category::all(['*']);
        //$this->authorize('view-any',Category::class);
        // $categories = $query->paginate();
        $categories = $query->leftJoin('categories as parents', 'parents.id', '=', 'categories.parent_id', 'parent')
            ->select([
                'categories.*',
                'parents.name as parent_name'
            ])
            // ->where('categories.status','=','active')
            ->orderBy('categories.created_at', 'DESC')
            ->orderBy('categories.name', 'ASC')
            ->withCount('products as count')
            ->withTrashed()
            ->paginate();

        $title = 'Categories List';

        // dd(compact('categories','title'));
        //egerload
        /* $categories = Category::with('parent')
            /*
            // will do filterd for all data and return specific data
            ->has('parent')
            ->whereHas('products', function($query) {
                $query->where('price','>',500);
                ->paginate();
            })*/

        $success = session()->get('success');
        return view('admin.categories.index', [
            'categories' => $categories,
            'title' => $title,
            'success' => $success,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$this->authorize('create', Category::class);
        $parents = Category::all();
        $category = new Category();
        return view('admin.categories.create', compact('category', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {

        // Validate the request data

        //    $clean =  $request->validate([
        //     'name'=> 'required|string|max:255|min:3',
        //     'parent_id' => 'nullable|int|exists:categories,id',
        //     'descraption' => 'nullable|min:5',
        //     'status' => 'required|in:active,draft',
        //     'image' => 'image|max:521000|dimensions:min_width=300,min_height=300',
        // ]);
        $rules = [
            'name' => 'required|string|max:255|min:3',
            'parent_id' => 'int|exists:categories,id',
            'descraption' => 'min:5', //nullable|min:5
            'status' => 'required|in:active,draft',
            'image' => 'image|max:521000|dimensions:min_width=300,min_height=300',
        ];
        // $clean = $request->validate($rules);
        // $data= $request->all();
        // $validator = Validator::make($data,$rules);

        // if($validator->fails()){
        //     return redirect()->back()->withErrors($validator);
        // }
        //can add attrbutes not in fiablle model
        $request->merge([
            'slug' => Str::slug($request->name),
            'status' => 'active',
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image_path = $file->store('/', [
                'disk' => 'catagory_images'
            ]);
            $request->merge([
                'image_path' => $image_path,
            ]);
        }

        // Method #1
        // $category = new Category();
        //     $category->name = $request->post('name');
        //     $category->slug = Str::slug($request->post('name'));
        //     $category->parent_id = $request->post('parent_id');
        //     $category->descraption = $request->post('descraption');
        //     $category->status = $request->post('status','active');
        //     $category->save();
        // dd($category);

        // Method #2
        // $category= Category::create([
        //     'name'=> $request->post('name'),
        //     'slug' => Str::slug($request->post('name')),
        //     'parent_id'=>   $request->post('parent_id'),
        //     'descraption'=> $request->post('descraption'),
        //     'status'=> $request->post('status','active'),
        // ]);
        $category =  Category::create($request->all());

        // Method #3 mass assigments
        // $category= new Category ([
        //     'name'=> $request->post('name'),
        //     'slug' => Str::slug($request->post('name')),
        //     'parent_id'=>   $request->post('parent_id'),
        //     'descraption'=> $request->post('descraption'),
        //     'status'=> $request->post('status','active'),
        // ]);
        //  $category->save();
        // Method #4 mass assigments
        // $category= new Category ($request->all());
        //  $c ategory->save();
        // PRG
        // dd($request);
        return redirect(route('catagories.index'))
            ->with('success', 'Category Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        // after egar load i will make it arrengment as ASC
        return $category->load([
            'parent',
            'products' => function ($query) {
                $query->orderBy('price', 'ASC')->where('status', 'active');
            }
        ]);
        // SELECT / FROM product WHERE category_id = ? ORDER BY price ASC
        return $category->products()
            ->with('category:id,name,slug')
            ->where('price', '>', 20)
            ->orderBy('price')
            ->get();
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

        $category = Category::findorfail($id);
        $parents = Category::withTrashed()->where('id', '<>', $category->id)->get();
        return view('admin.categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        //Mass Assigment
        //Category::where('id','=',$id)->update($request->all());
        $category = Category::find($id);
        $rules = [
            'name' => 'required|string|max:255|min:3',
            'parent_id' => 'nullable|int|exists:categories,id',
            'descraption' => 'min:5', //nullable|min:5
            'status' => 'required|in:active,draft',
            'image' => 'image|max:521000|dimensions:min_width=300,min_height=300',
        ];

        // $clean = $request->validate($rules);
        $request->merge([
            'slug' => Str::slug($request->name),
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image_path = $file->store('/', [
                'disk' => 'catagory_images'
            ]);
            $request->merge([
                'image_path' => $image_path,
            ]);
        }

        // Mehtod #1
        // $category->name = $request->post('name');
        // $category->parent_id = $request->post('parent_id');
        // $category->descraption = $request->post('descraption');
        // $category->status = $request->post('status','active');
        // $category->save();

        // Mehtod #2: mass assigment
        $category->update($request->all());

        // Mehtod #3: mass assigment
        //  $category->fill($request->all())->save();
        //    PRG
        return redirect()->route('catagories.index')
            ->with('success', 'Category Updated!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Method #1
        // $category = Category::find($id);
        // $category->delete();

        //Method #2
        Category::destroy($id);

        //Method #3
        // Category::where('id','=',$id)->delete();

        // wtire into sessions
        // Session::put();
        session()->put('success', 'category deleted!');
        // session([
        //     'success'=>'category deleted!',
        // ]);

        // // read from session
        // Session::get();
        // session()->get('success');

        // // Delete From session
        // Session::forget();
        // session()->forget('success');
        // PRG
        return redirect()->route('catagories.index')
            ->with('success', 'Category Deleted!');
    }
}
