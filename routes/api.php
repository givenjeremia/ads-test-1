<?php

use App\Models\karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\KaryawanResource;
use App\Http\Controllers\KaryawanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

//     // Endpoint untuk menampilkan daftar karyawan
//     Route::get('/karyawan', function () {
//         return KaryawanResource::collection(karyawan::all());
//     });

//     // Endpoint untuk menambahkan karyawan
//     Route::post('/karyawan', [KaryawanController::class, 'store']);

//     // Endpoint untuk mengedit karyawan
//     Route::put('/karyawan/{id}', [KaryawanController::class, 'update']);
// });

Route::middleware('auth:sanctum')->group(function () {
    // daftar route yang memerlukan autentikasi Sanctum
    // Endpoint untuk menampilkan daftar karyawan
});
Route::apiResource('/karyawan', KaryawanController::class);

