<?php

use App\Http\Controllers\{
    CompanyController,
    DocumentController,
    FinanceController,
    ImageController,
    LoginHistoryController,
};
use App\Models\Company;
use App\Models\LoginHistory;
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

Route::controller(LoginHistoryController::class)->prefix('login')->group(function() {
    Route::get('/create', 'create')->name('login_history.create');
    Route::post('/', 'store')->name('login_history.store');
});

Route::controller(ImageController::class)->prefix('image')->group(function() {
    Route::get('/create', 'create')->name('image.create');
    Route::post('store', 'store')->name('image.store');
    Route::get('show', 'show')->name('image.show');
    Route::post('edit', 'edit')->name('image.edit');
});

Route::controller(FinanceController::class)->prefix('finance')->group(function() {
    Route::get('config/create', 'createConfig')->name('finance.create_config');
    Route::get('config/store', 'storeConfig')->name('finance.store_config');
});

Route::controller(CompanyController::class)->prefix('company')->group(function() {
    Route::get('/create', 'create')->name('company.create');
    Route::post('/', 'store')->name('company.store');
    Route::get('/', 'index')->name('company.index');
});

Route::controller(DocumentController::class)->prefix('document')->group(function() {
    Route::get('/create', 'create')->name('document.create');
    Route::post('/', 'store')->name('document.store');
});