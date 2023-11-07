<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FridgeController;
use App\Http\Controllers\AddFridgeController;
use App\Http\Controllers\FridgeEditController;
use App\Http\Controllers\FridgeContentController;
use App\Http\Controllers\ShowController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('add', [AddFridgeController::class, 'edit'])->name('add.fridge');
    Route::post('add', [AddFridgeController::class, 'store']);

    Route::get('show', [ShowController::class, 'edit'])->name('show');
    Route::get('showcomment', [ShowController::class, 'showcomment'])->name('showcomment');
    Route::get('solved', [ShowController::class, 'solved'])->name('solved');
    Route::get('solvedcomment', [ShowController::class, 'solvedcomment'])->name('solvedcomment');
    Route::get('expiredproduct', [ShowController::class, 'expiredproduct'])->name('expiredproduct');

    Route::get('/show/edit/{fridgeId}', [FridgeEditController::class, 'edit'])->name('fridgeedit.edit');
    Route::patch('/show/edit/{fridgeId}', [FridgeEditController::class, 'update'])->name('fridgeedit.update');
    Route::delete('/show/edit/{fridgeId}', [FridgeEditController::class, 'delete'])->name('fridgeedit.delete');

    Route::get('/show/content/{fridgeId}', [FridgeContentController::class, 'edit'])->name('content.edit');
    Route::patch('/show/content/{fridgeId}/{productId}', [FridgeContentController::class, 'update'])->name('content.update');
});

Route::post('/selecttable', [FridgeController::class, 'selectTable'])->name('selecttable');
Route::get('/fridgedetail', [FridgeController::class, 'detail'])->name('fridgedetail');
Route::post('/comment', [FridgeController::class, 'comment'])->name('comment');

require __DIR__.'/auth.php';
