<?php

use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MembersController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    // Route Books
    Route::apiResource('books', BooksController::class);
    // Route Category
    Route::apiResource('category', CategoryController::class);
    // Route Authors
    Route::apiResource('authors', AuthorsController::class);
    // Route Borrowing
    Route::apiResource('borrowing', BorrowingController::class);

    //Route Members
    Route::apiResource('members', MembersController::class);
});