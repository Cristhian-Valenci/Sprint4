<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CocktailController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', [CocktailController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::resource('cocktails', CocktailController::class);

require __DIR__.'/auth.php';
