<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PasienController;

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

route::resource('pasien', PasienController::class);
Route::resource('profil', ProfilController::class);
Route::get('profil', [App\Http\Controllers\ProfilController::class, 'index']);
Route::get('create', [ProfilController::class, 'create']);
Route::get('profil/{nama}/{id}/edit', [ProfilController::class, 'edit']);
Route::get('profil/create', [ProfilController::class, 'create'])->name('profil.create');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
