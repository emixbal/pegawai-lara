<?php

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

// Auth::routes();
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'login'], function () {
    Route::get('/', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::post('/process', [App\Http\Controllers\AuthController::class, 'login_process'])->name('login.process');
});

Route::group(['prefix' => '/', 'middleware' => ['auth']], function () {
    Route::get('/', [App\Http\Controllers\PegawaiController::class, 'index'])->name('home.index');
});

Route::group(['prefix' => 'pegawai', 'middleware' => ['auth']], function () {
    Route::get('/', [App\Http\Controllers\PegawaiController::class, 'index'])->name('pegawai.index');
    Route::post('/', [App\Http\Controllers\PegawaiController::class, 'store'])->name('pegawai.store');
    Route::put('/{id}', [App\Http\Controllers\PegawaiController::class, 'update'])->name('pegawai.update');
    Route::delete('/{id}', [App\Http\Controllers\PegawaiController::class, 'delete'])->name('pegawai.delete');
});

Route::group(['prefix' => 'department', 'middleware' => ['auth']], function () {
    Route::get('/', [App\Http\Controllers\DepartmentController::class, 'index'])->name('department.index');
    Route::post('/', [App\Http\Controllers\DepartmentController::class, 'store'])->name('department.store');
    Route::put('/{id}', [App\Http\Controllers\DepartmentController::class, 'update'])->name('department.update');
    Route::delete('/{id}', [App\Http\Controllers\DepartmentController::class, 'delete'])->name('department.delete');
});

Route::get('/file/{dir}/{filename}', function ($dir, $filename) {
    $path = storage_path("app/public/$dir/" . $filename);
    if (!file_exists($path)) {
        abort(404);
    }
    return response()->file($path);
}, )->name('file')->middleware(['auth']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth']);
