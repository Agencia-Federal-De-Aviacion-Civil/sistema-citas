<?php

use App\Http\Controllers\afac\homeController;
use App\Http\Controllers\afac\schedule\IndexController;
use App\Http\Controllers\afac\schedule\userMedicine;
use App\Http\Controllers\RoleController;
use App\Http\Livewire\Headquarters\HomeHeadquarter;
use App\Http\Livewire\Linguistics\HomeLinguistics;
use App\Http\Livewire\Register\Peoplehistoryrecords;
use App\Http\Livewire\Medicine\HomeMedicine;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Validate\Qr as ValidateQr;

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

Route::get('', [homeController::class, 'index'])->name('afac.home');
Route::group(['middleware' => ['role:super_admin|user|medicine_admin']], function () {
    Route::get('/medicine', HomeMedicine::class)->name('afac.medicine');
    Route::get('/linguistics', HomeLinguistics::class)->name('afac.linguistics');
    Route::get('/download', [HomeMedicine::class, 'generatePdf'])->name('download');
});
// TODO
Route::group(['middleware' => ['role:super_admin|medicine_admin']], function () {
    Route::get('headquarters', HomeHeadquarter::class)->name('afac.headquarterMedicine');
    Route::get('/register', Peoplehistoryrecords::class)->name('afac.historyRegister');
    //Route::get('/medicine', HomeMedicine::class)->name('afac.medicine');
    Route::get('/validate', ValidateQr::class)->name('validate');
});
Route::get('/appointments', [IndexController::class, 'index'])->name('afac.appointment');
Route::get('/users', [userMedicine::class, 'index'])->name('afac.users');
Route::get('/downloadFile/{scheduleId}', [IndexController::class, 'download'])->name('afac.downloadFile');

Route::resource('/roles', RoleController::class)->names('afac.roles');

// Route::get('/downloads', [AppointmentHistory::class, 'test'])->name('downloads');
