<?php

use App\Http\Controllers\ImageController;
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
    return to_route('image.create');
});

Route::controller(ImageController::class)->prefix('image')->group(function() {
    Route::get('create', 'create')->name('image.create');
    Route::post('store', 'store')->name('image.store');
    Route::get('show', 'show')->name('image.show');
    Route::post('edit', 'edit')->name('image.edit');
});
