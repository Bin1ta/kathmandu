<?php

use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CitizenCharterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\FileController;
use App\Http\Controllers\Admin\FileUploadController;
use App\Http\Controllers\Admin\HallController;
use App\Http\Controllers\Admin\HallDetailController;
use App\Http\Controllers\Admin\HeaderController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\OfficeSettingController;
use App\Http\Controllers\Admin\PopUpController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\RevenueController;
use App\Http\Controllers\Admin\UserManagement\RoleController;
use App\Http\Controllers\Admin\UserManagement\UserController;
use App\Http\Controllers\Admin\VideoController;
use Illuminate\Support\Facades\Route;

Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
Route::patch('profile/update', [ProfileController::class, 'updateProfile'])->name('updateProfile');
Route::patch('password/update', [ProfileController::class, 'updatePassword'])->name('updatePassword');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('dashboard/ajax-dashboard-request', [DashboardController::class, 'ajaxDashboardRequest'])->name('dashboard.ajax-dashboard-request');

Route::post('file-upload/chunkStore', [FileUploadController::class, 'chunkFileStore'])->name('fileUpload.chunkStore');

Route::resource('video', VideoController::class);
Route::put('video/{video}/updateVideoStatus', [VideoController::class, 'updateVideoStatus'])->name('video.updateStatus');
Route::resource('branch', BranchController::class);
Route::resource('hall', HallController::class);
Route::resource('hallDetail', HallDetailController::class);
Route::resource('citizenCharter', CitizenCharterController::class);
Route::resource('header', HeaderController::class);
Route::resource('revenue', RevenueController::class);
Route::resource('program', ProgramController::class);
Route::put('program/{program}/updateProgramStatus', [ProgramController::class, 'updateProgramStatus'])->name('program.updateStatus');

Route::get('employee/{employee}/updateEmployeeStatus', [EmployeeController::class, 'updateEmployeeStatus'])->name('employee.updateEmployeeStatus');
Route::resource('employee', EmployeeController::class);

Route::resource('{type}/notice', NoticeController::class);
Route::get('hallDetail/{hallDetail}/hallDetailUpdate',[HallDetailController::class,'updateStatus'])->name('hallDetail.updateStatus');
Route::get('hall/{hall}/hallUpdate',[HallController::class,'updateStatus'])->name('hall.updateStatus');
Route::get('{type}/notice/{notice}/noticeUpdate', [NoticeController::class, 'updateClosedDate'])->name('notice.updateClosedDate');
Route::get('{type}/notice/{notice}/updateShowOnIndex', [NoticeController::class, 'updateShowOnIndex'])->name('notice.updateShowOnIndex');

Route::get('file/{file}/download', [FileController::class, 'download'])->name('file.download');
Route::get('file-download', [FileController::class, 'downloadFile'])->name('file-url-download');
Route::resource('file', FileController::class)
    ->only('show', 'index', 'store', 'destroy');

Route::prefix('systemSetting')->as('systemSetting.')->group(function () {
    Route::resource('officeSetting', OfficeSettingController::class)
        ->only('index', 'store');


    Route::prefix('userManagement')->as('userManagement.')->group(function () {
        Route::resource('role', RoleController::class);
        Route::get('user/{user}/updateStatus', [UserController::class, 'updateStatus'])->name('user.updateStatus');
        Route::resource('user', UserController::class);
    });
});

Route::put('popUpSetting/{popUpSetting}/updateStatus', [PopUpController::class, 'updateStatus'])->name('popUpSetting.updateStatus');
Route::resource('popUpSetting', PopUpController::class);

