<?php

namespace App\Http\Controllers;

use App\Models\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Members\StoreMemberRequest;
use App\Http\Requests\Members\UpdateMemberRequest;
class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Members::all();
        return response()->json([
            'status' => 'success',
            'data' => $members
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberRequest $request)
    {
        $member = Members::create($request->validated());

        return response()->json([
            'status' => 'success',
            'data' => $member
        ],201);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $member = DB::table('members')->find($id);
        if (!$member) {
            return response()->json([
                'status' => 'error',
                'message' => 'teacher not found'
            ], 404);
        }
        return response()->json([ 'status' => 'success', 'data' => $member]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberRequest $request, $id)
    {
        $member = Members::find($id);
        if (!$member) {
            return response()->json(['message' => 'members not found'], 404);
        }
        $member->update($request->validated());
        return response()->json([ 'status' => 'success', 'data' => $member],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $members = Members::find($id);
        if (!$members) {
            return response()->json(['message' => 'Member not found'], 404);
        }
        $members->delete();
        return response()->json(['message' => 'Member deletes successfully']);
    }
}
