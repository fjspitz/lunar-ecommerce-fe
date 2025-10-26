<?php

use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SearchController::class, 'index'])->name('welcome');
Route::get('/search_by_name', [SearchController::class, 'searchByName'])->name('search.name');
Route::get('/search_by_category', [SearchController::class, 'searchByCategory'])->name('search.category');
Route::get('/search_by_brand', [SearchController::class, 'searchByBrand'])->name('search.brand');
