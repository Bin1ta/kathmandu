<?php

use App\Http\Controllers\Api\v1\DigitalBoardController;

Route::get('home', [DigitalBoardController::class, 'home'])->name('home');
Route::get('ward/{ward}/home', [DigitalBoardController::class, 'ward'])->name('ward');
Route::get('officeSetting', [DigitalBoardController::class, 'officeSetting'])->name('officeSetting');
