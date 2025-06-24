<?php

namespace App\Http\Controllers;

use App\Models\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Members::all();
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
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'nullable|string|max:3',
            'email' => 'required|email|unique:members,email',
            'address' => 'nullable|string|max:255',
        ]);

        $member = new Members();
        $member->name = $request->input('name');
        $member->age = $request->input('age');
        $member->email = $request->input('email');
        $member->address = $request->input('address');
        $member->save();

        return response()->json([
            'status' => 'success',
            'data' => $member
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $members = DB::table('members')->find($id);
        if (!$members) {
            return response()->join([
                'status' => 'error',
                'message' => 'teacher not found'
            ], 404);
        }
        return response()->json($members);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $fillable, $id)
    {
        $members = Members::find($id);
        if (!$members) {
            return response()->json(['message' => 'members not found'], 404);
        }
        $members->update($fillable->all());
        return response()->json($members);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Members::find($id);
        if (!$category) {
            return response()->json(['message' => 'Member not found'], 404);
        }
        $category->delete();
        return response()->json(['message' => 'Member deletes successfully']);
    }
}
