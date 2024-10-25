<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\CardController::class, 'main'])->name('dashboard');

//Route::get('/', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/card/create', [CardController::class, 'create'])->name('card.create');
    Route::post('card/create', [CardController::class, 'store'])->name('card.store');
    Route::get('/card/my_cards', [CardController::class, 'myCards'])->name('card.showMyCards');
    Route::get('/card/{id}/edit', [CardController::class, 'edit'])->name('card.edit');

});
Route::get('/card/{id}', [CardController::class, 'show'])->name('card.show');
require __DIR__.'/auth.php';
