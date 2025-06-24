<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Books;
use Illuminate\Http\Request;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;


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
    public function store(StoreBookRequest $request)
    {
        $book = Books::create($request->validated());
        return response()->json([
            'status' => 'success',
            'data' => $book
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
                'message' => 'Book not found'
            ], 404);
        }
        return response()->json($books);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, $id)
    {
        $books = Books::find($id);
        if (!$books){
            return response()->json(['message' => 'Books not found'], 404);
        }
        $books->update($request->validated());
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
