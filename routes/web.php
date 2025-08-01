<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/extend/{loanId}', [DashboardController::class, 'extend'])->name('dashboard.extend');
    Route::post('/dashboard/return/{loanId}', [DashboardController::class, 'return'])->name('dashboard.return');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('books', BookController::class)->only(['index', 'show']);
Route::post('books/{id}/borrow', [BookController::class, 'borrow'])->name('books.borrow');
Route::post('books/{id}/purchase', [BookController::class, 'purchase'])->name('books.purchase');
Route::get('books/{id}/read', [BookController::class, 'read'])->name('books.read');

Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';
