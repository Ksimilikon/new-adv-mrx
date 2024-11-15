<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\ModerMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [CardController::class, 'main'])->name('dashboard');

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
    Route::get('/card/marked', [CardController::class, 'marked'])->name('card.marked');

    Route::post('/card/ban', [CardController::class, 'userBan'])->name('user.card.ban');
    Route::post('/card/mark/out', [CardController::class, 'markOutCard'])->name('card.mark.out');
    Route::post('/card/mark/in', [CardController::class, 'markInCard'])->name('card.mark.in');

});
Route::get('/card/{id}', [CardController::class, 'show'])->name('card.show');

Route::middleware(ModerMiddleware::class, 'auth')->group(function (){
    Route::post('/card/moder/ban', [CardController::class, 'moderBan'])->name('moder.card.ban');
});
require __DIR__.'/auth.php';
