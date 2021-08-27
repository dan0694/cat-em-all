<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.register');
});

Route::get('/dashboard', [CatController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::prefix('cat')->group(function() {
    Route::get('/new', [CatController::class, 'create'])->middleware(['auth'])->name('create');
    Route::post('/new', [CatController::class, 'store'])->middleware(['auth'])->name('store');
    Route::get('/edit/{id}', [CatController::class, 'edit'])->middleware(['auth'])->name('edit');
    Route::put('/edit/{id}', [CatController::class, 'update'])->middleware(['auth'])->name('update');
    Route::delete('/destroy/{id}', [CatController::class, 'destroy'])->middleware(['auth'])->name('destroy');
    Route::get('/locate/{id}', [CatController::class, 'show'])->middleware(['auth'])->name('locate');
    Route::get('/map', [CatController::class, 'map'])->middleware(['auth'])->name('map');
});

require __DIR__.'/auth.php';

