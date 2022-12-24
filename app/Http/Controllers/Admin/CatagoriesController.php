<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use Illuminate\Support\Str;
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

        //return collection of model catagory
        //$categories = Category::all(['*']);

        $categories = Category::leftJoin('categories as parents','parents.id','=','categories.parent_id')
            ->select([
            'categories.*',
            'parents.name as parent_name'
        ])
            ->where('categories.status','=','active')
            ->orderBy('categories.created_at', 'DESC')
            ->orderBy('categories.name','ASC')
            ->get();

        $title ='Categories List';

        // dd(compact('categories','title'));

        return view('admin.categories.index', [
            'categories'=> $categories,
            'title'=> $title,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = Category::all();
        return view('admin.categories.create',compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->all();

        // Method #1
    $category = new Category();
        $category->name = $request->post('name');
        $category->slug = Str::slug($request->post('name'));
        $category->parent_id = $request->post('parent_id');
        $category->descraption = $request->post('descraption');
        $category->status = $request->post('status','active');
        $category->save();
        // dd($category);

    //     // Method #2
    // $category= Category::create([
    //     'name'=> $request->post('name'),
    //     'slug' => Str::slug($request->post('name')),
    //     'parent_id'=>   $request->post('parent_id'),
    //     'descraption'=> $request->post('descraption'),
    //     'status'=> $request->post('status','active'),
    // ]);

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

    return redirect(route('catagories.index'));

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
