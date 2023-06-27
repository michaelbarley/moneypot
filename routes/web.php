<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\PotController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
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
Route::get('/pots/{pot}', [PotController::class, 'show'])->name('view pot');
Route::get('/pots/{pot}/contributions/{method}', [TransactionController::class, 'create'])->name('create transaction');
Route::post('/pots/{pot}/contributions/{method}', [PotController::class, 'makeTransaction'])->name('store transaction');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/user/profile', [UserController::class, 'edit'])->name('user profile');
    Route::post('/user/profile', [UserController::class, 'update'])->name('update profile');
    Route::get('/', [PotController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [PotController::class, 'index'])->name('dashboard');
    Route::get('/pots/{pot}/edit', [PotController::class, 'edit'])->name('manage pot');
    Route::get('/pots/create/new', [PotController::class, 'create'])->name('create pot form');
    Route::post('/pots', [PotController::class, 'store'])->name('store pot');
    Route::put('/pots/{pot}', [PotController::class, 'update'])->name('update pot');
    Route::get('/pots/{pot}/close', [PotController::class, 'destroy'])->name('delete pot');
    Route::get('/pots/{pot}/suspend', [PotController::class, 'destroy'])->name('suspend pot');
    Route::get('/pots/{pot}/unsuspend', [PotController::class, 'unsuspend'])->name('unsuspend pot');
    Route::get('/pots/{pot}/administrators/share/create', [AdministratorController::class, 'create'])->name('invite admin form');
    Route::post('/pots/{pot}/administrators/share/store', [AdministratorController::class, 'store'])->name('invite admin');
    Route::delete('/pots/{pot}/administrators/{user}/share/delete', [AdministratorController::class, 'destroy'])->name('delete admin');
});
