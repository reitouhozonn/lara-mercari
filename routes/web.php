<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyPage\ProfileController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\MyPage\SoldItemController;
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
    return view('welcome');
})->name('top');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('items/{item}', function ($id) {
    return "商品説明";})->name('item');

Route::prefix('/sell')
    ->name('sell')
    ->middleware('auth')
    ->group(function () {
        Route::get('', [SellController::class, 'showSellForm']);
        Route::post('', [SellController::class, 'sellItem']);
    });

Route::prefix('/mypage')
    ->name('mypage.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/edit-profile', [ProfileController::class, 'showProfileEditForm'])->name('edit-profile');
        Route::post('/edit-profile', [ProfileController::class, 'editProfile'])->name('edit-profile');

        Route::get('/sold-items', [SoldItemController::class, 'showSoldItems'])->name('sold-items');
    });