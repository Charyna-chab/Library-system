<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use App\Http\Requests\Borrowing\StoreBorrowRequest;
use App\Http\Requests\Borrowing\UpdateBorrowRequest;
class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $borrowing = Borrowing::all();
         return response()->json([
            'status' => 'Borrowing',
            'data' => $borrowing
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBorrowRequest $request)
    {
        
        $borrowing = Borrowing::create($request->validated());
        return response()->json([
            'status' => 'Borrowing success',
            'date' => $borrowing
        
        ]);



    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $borrowing = DB::table('borrowing')->find($id);
        if(!$borrowing){
            return response()->json([
                'status' => 'error',
                'message' => 'Borrowing not found'
            ],404);
        }
        return response()->json($borrowing);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBorrowRequest $request,$id)
    {
        $borrowing = Borrowing::find($id);
        if (!$borrowing){
            return response()->json(['message' => 'Borrowing not found'], 404);
        }
        $borrowing->update($request->validated());
        return response()->json($borrowing);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $borrowing = Borrowing::find($id);
        if (!$borrowing){
            return response()->json(['message' => 'Borrowing not found'], 404);
        }
        $borrowing->delete();
        return response()->json(['message' => 'Borrowing deletes successfully']);
    }
}
