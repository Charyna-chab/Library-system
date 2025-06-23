<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        return response()->json([
            'status' => 'success',
            'data' => $category
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->category_name->$request->input('category_name');
        $category->save();
         return response()->json([
            'status' => 'success',
            'data' => $category
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = DB::table('books')->find($id);
        if (!$category){
            return response()->join([
                'status' => 'error',
                'message' => 'teacher not found'
            ], 404);
        }
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $fillable, $id)
    {
       $category = Category::find($id);
        if (!$category){
            return response()->json(['message' => 'Category not found'], 404);
        }
        $category->update($fillable->all());
        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $category = Category::find($id);
        if (!$category){
            return response()->json(['message' => 'Category not found'], 404);
        }
        $category->delete();
        return response()->json(['message' => 'Category deletes successfully']);
    }
}
