<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GridMapController;
use App\Livewire\MarkerMap;
use App\Livewire\PetaKustom;
use App\Http\Controllers\PetaKustomController; 


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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('user','fireauth');

Route::get('/email/verify', [App\Http\Controllers\Auth\ResetController::class, 'verify_email'])->name('verify')->middleware('fireauth');

Route::post('login/{provider}/callback', 'Auth\LoginController@handleCallback');

Route::get('/home/iamadmin', [App\Http\Controllers\MakeAdminController::class, 'index'])->middleware('user','fireauth');

// Route::resource('/home/profile', App\Http\Controllers\Auth\ProfileController::class)->name('profile')->middleware('user','fireauth');

Route::get('/home/profile', [App\Http\Controllers\Auth\ProfileController::class, 'index'])->name('profile.index')->middleware('user','fireauth');
Route::patch('/home/profile/update/{profile}', [App\Http\Controllers\Auth\ProfileController::class, 'update'])->name('profile.update')->middleware('user','fireauth');
Route::delete('/home/profile/delete/{profile}', [App\Http\Controllers\Auth\ProfileController::class, 'destroy'])->name('profile.destroy')->middleware('user','fireauth');


Route::resource('/home/admin', App\Http\Controllers\Auth\AdminController::class)
    ->middleware('user')
    ->middleware('fireauth')
    ->middleware('isAdmin');


Route::resource('/password/reset', App\Http\Controllers\Auth\ResetController::class);

Route::get('/gridmap', \App\Livewire\MarkerMap::class);


Route::get('/vehicles', function () {
    return view('vehicles.index');
});

// routes/web.php
Route::get('/peta-kustom', PetaKustom::class)->name('peta.index');

?>
