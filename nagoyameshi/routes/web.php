<?php

use App\Http\Middleware\Subscribed;
use App\Http\Middleware\NotSubscribed;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SubscriptionController;
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

Route::get('/', [StoreController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('stores', [StoreController::class, 'index'])->name('stores.index');

Route::middleware(['auth', 'verified'])->group(function() {
    Route::resource('stores', StoreController::class)->except(['index']);
    Route::get('stores/{store}/reviews', [ReviewController::class, 'show'])->name('reviews.show');
    Route::post('reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('stores/{store}/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('stores/{store}/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('stores/{store}/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    Route::post('favorites/{store}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('favorites/{store}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

    Route::controller(UserController::class)->group(function () {
    Route::get('users/mypage', 'mypage')->name('mypage');
    Route::get('users/mypage/show', 'show')->name('mypage.show');
    Route::get('users/mypage/edit', 'edit')->name('mypage.edit');
    Route::put('users/mypage', 'update')->name('mypage.update');
    Route::get('users/mypage/password/edit', 'edit_password')->name('mypage.edit_password');
    Route::put('users/mypage/password', 'update_password')->name('mypage.update_password');
    Route::get('users/mypage/favorite', 'favorite')->name('mypage.favorite'); 
    Route::delete('users/mypage/delete', 'destroy')->name('mypage.delete');
    });

    Route::delete('users/mypage/favorite/{store}', [FavoriteController::class, 'destroy'])->name('mypage.favorite.destroy');

    Route::controller(ReservationController::class)->group(function () {
        Route::get('stores/{store}/reservations/create', 'create')->name('reservations.create');
        Route::post('stores/{store}/reservations', 'store')->name('reservations.store');
        Route::get('reservations', 'index')->name('reservations.index');
        Route::delete('stores/{store}/reservations/{reservation}', 'destroy')->name('reservations.destroy');
    });

    Route::group(['middleware' => [NotSubscribed::class]], function () {
        Route::get('subscription/create', [SubscriptionController::class, 'create'])->name('subscription.create');
        Route::post('subscription', [SubscriptionController::class, 'store'])->name('subscription.store');
    });

    Route::group(['middleware' => [Subscribed::class]], function () {
        Route::get('subscription/edit', [SubscriptionController::class, 'edit'])->name('subscription.edit');
        Route::patch('subscription', [SubscriptionController::class, 'update'])->name('subscription.update');
        Route::get('subscription/cancel', [SubscriptionController::class, 'cancel'])->name('subscription.cancel');
        Route::delete('subscription', [SubscriptionController::class, 'destroy'])->name('subscription.destroy');
    });
});

