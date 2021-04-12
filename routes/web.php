<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\MyPage\ProfileController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\MyPage\SoldItemController;
use App\Http\Controllers\MyPage\BoughtItemsController;

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

Route::get('/', [ItemsController::class, 'showItems'])->name('top');

Auth::routes();

Route::get('items/{item}', [ItemsController::class, 'showItemDetail'])->name('item');

Route::prefix('items')
    ->name('item.buy')
    ->middleware('auth')
    ->group(function () {
        Route::get('/{item}/buy', [ItemsController::class, 'showByItemForm']);
        Route::post('/{item}/buy', [ItemsController::class, 'byItem']);
    });


    


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
        Route::get('/bought-items', [BoughtItemsController::class, 'showBoughtItems'])->name('bought-items');
        Route::get('/sold-items', [SoldItemController::class, 'showSoldItems'])->name('sold-items');
    });