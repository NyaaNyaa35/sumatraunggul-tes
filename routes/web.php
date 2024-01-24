<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MainController;

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

Route::get('/', [MainController::class,'show']);
Route::get('/tableManagement', [MainController::class,'tableManagement']);

Route::post('/add/kendaraan', [MainController::class,'insertKendaraan']);
Route::post('/add/transaksi', [MainController::class,'insertTransaksi']);

Route::delete('/delete/kendaraan/{no_plat}', [MainController::class,'deleteKendaraan']);
Route::delete('/delete/transaksi/{idTransaksi}', [MainController::class,'deleteTransaksi']);

Route::delete('/edit/kendaraan/{no_plat}', [MainController::class,'editKendaraan']);
Route::delete('/edit/transaksi/{idTransaksi}', [MainController::class,'editTransaksi']);
