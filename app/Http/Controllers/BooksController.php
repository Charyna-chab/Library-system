<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Books;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Books::all();
        return response()->json([
            'status' => 'success',
            'data' => $books
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $books = new Books();
        $books->title = $request->input('title');
        $books->category_id = $request->input('category_id');
        $books->author_id = $request->input('author_id');
        $books->save();
        return response()->json([
            'status' => 'success',
            'data' => $books
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $books = DB::table('books')->find($id);
        if (!$books){
            return response()->join([
                'status' => 'error',
                'message' => 'teacher not found'
            ], 404);
        }
        return response()->json($books);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $fillable, $id)
    {
        $books = Books::find($id);
        if (!$books){
            return response()->json(['message' => 'Books not found'], 404);
        }
        $books->update($fillable->all());
        return response()->json($books);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $books = Books::find($id);
        if (!$books){
            return response()->json(['message' => 'Books not found'], 404);
        }
        $books->delete();
        return response()->json(['message' => 'Book deletes successfully']);
    }
}
