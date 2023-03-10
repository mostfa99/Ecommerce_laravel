<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->user()->tokenCan('categories.create')) {
            abort(403, 'not allowed ');
        }
        $categories = Category::with('parent')
            ->when($request->query('parent_id'), function ($query, $value) {
                $query->where('parent_id', '=', $value);
            })->paginate();
        return  CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'parent_id' => 'nullable|int|exists:categories,id',
        ]);

        $category = Category::create($request->all());
        $category->refresh()->load('children');   //select * from catagroires where id = ?

        // return  response()->json($category, 201);
        /*return  Response::json($category, 201, [
            'x-application-name' => config('app.name'),
        ]);*/
        // return $category;
        return new JsonResponse($category, 201, [
            'x-application-name' => config('app.name'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category =  Category::with('children')->findOrFail($id);
        return new CategoryResource($category);
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
        $request->validate([
            'name' => 'sometimes|required',
            'parent_id' => 'nullable|int|exists:categories,id',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());
        return Response::json([
            'message' => 'sucssefuly updated',
            'category' => $category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return Response::json([
            'message' => 'Category Deleted',
        ]);
    }
}
