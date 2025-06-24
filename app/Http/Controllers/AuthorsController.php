<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Authors\StoreAuthorRequest;
use App\Http\Requests\Authors\UpdateAuthorRequest;
use PharIo\Manifest\Author;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Authors::all();
        return response()->json([
            'status' => 'success',
            'data' => $authors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuthorRequest $request)
    {
       $author = Authors::create($request->validated());
        return response()->json(['status' => 'success', 'data' => $author], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $authors = DB::table('authors')->find($id);
        if (!$authors){
            return response()->join([
                'status' => 'error',
                'message' => 'Authors not found'
            ], 404);
        }
        return response()->json(['status' => 'success', 'data' => $authors]);
    }

    /**
     * Update the specified resource in storage.
     */
        public function update(UpdateAuthorRequest $request, $id)
    {
        $author = Authors::find($id);

        if (!$author) {
            return response()->json(['message' => 'Author not found'], 404);
        }

        $author->update($request->validated());

        return response()->json(['status' => 'success', 'data' => $author]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       $authors = Authors::find($id);
        if (!$authors){
            return response()->json(['message' => 'Authors not found'], 404);
        }
        $authors->delete();
        return response()->json(['message' => 'Authors deletes successfully']);
    }
}