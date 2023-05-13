<?php

use App\Http\Controllers\CutiController;
use App\Http\Controllers\KaryawanController;
use Illuminate\Support\Facades\Route;

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

Route::resource('/',KaryawanController::class);

Route::resource('karyawan',KaryawanController::class);
Route::get('karyawanPertamaGabung',[KaryawanController::class,'karyawanPertamaGabung']);
Route::post('/karyawan/getEditForm',[KaryawanController::class,'getEditForm'])->name('karyawan.getEditForm');

Route::resource('cuti',CutiController::class);
Route::post('/cuti/getEditForm',[CutiController::class,'getEditForm'])->name('cuti.getEditForm');
Route::get('cutiKaryawan',[CutiController::class,'cutiKaryawan']);
Route::get('cutiLebihDariSekali',[CutiController::class,'cutiLebihDariSekali']);
Route::get('sisaCuti',[CutiController::class,'sisaCuti']);



