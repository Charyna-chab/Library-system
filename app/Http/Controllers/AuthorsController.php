<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'Nationality' => 'required|string|max:255',
        ]);

        $author = Authors::create($validated);
        return response()->json(['status' => 'success', 'data' => $author], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Authors $authors)
    {
        $authors->load('books'); // Load books relationship
        return response()->json(['status' => 'success', 'data' => $authors]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Authors $authors)
    {
        $validated = $request->validate([
            'FirstName' => 'sometimes|required|string|max:255',
            'LastName' => 'sometimes|required|string|max:255',
            'Nationality' => 'sometimes|required|string|max:255',
        ]);

        $authors->update($validated);
        return response()->json(['status' => 'success', 'data' => $authors]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Authors $authors)
    {
        $authors->delete();
        return response()->json(['status' => 'success'], 204);
    }
}