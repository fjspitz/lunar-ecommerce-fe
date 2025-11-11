<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SearchController;
use App\Livewire\Cart;
use Illuminate\Support\Facades\Route;

Route::get('/', [SearchController::class, 'index'])->name('welcome');
// Route::get('/search_by_name', [SearchController::class, 'searchByName'])->name('search.name');
// Route::get('/search_by_category', [SearchController::class, 'searchByCategory'])->name('search.category');
// Route::get('/search_by_brand', [SearchController::class, 'searchByBrand'])->name('search.brand');

Route::get('/search', [SearchController::class, 'search'])->name('search');

//Route::get('cart', [CartController::class, 'index'])->name('cart.index')->middleware('auth');
Route::get('cart', Cart::class)->name('cart.index')->middleware('auth');
Route::post('cart', [CartController::class, 'add'])->name('cart.add')->middleware('auth');

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'authenticate'])->name('login.auth');
