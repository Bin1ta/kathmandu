<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\LoginController;
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

Route::get('/', [FrontController::class,'index'])->name('welcome');
Route::get('ward/{ward}', [FrontController::class,'wardIndex'])->name('wardIndex');
Route::get('/newWard', [FrontController::class,'newward'])->name('newWard');

Route::post('/login', [LoginController::class,'login'])->name('login');
Route::get('/login', [LoginController::class,'loginPage'])->name('loginPage');
Route::post('/logout', [LoginController::class,'logout'])->name('logout')->middleware('auth:sanctum');
