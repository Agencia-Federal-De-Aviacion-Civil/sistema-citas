<?php

use App\Http\Controllers\Afac\Appointment\AppointmentController;
use App\Http\Controllers\afac\homeController;
use App\Http\Controllers\AppointmentMedicineController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserMedicineController;
use App\Http\Livewire\Headquarters\HomeHeadquarter;
use App\Http\Livewire\Linguistics\HomeLinguistics;
use App\Http\Livewire\Medicine\HomeMedicine;
use App\Http\Livewire\Medicine\HistoryMedicieMovements;
use App\Http\Livewire\Linguistics\HistoryLinguisticsMovements;
use App\Http\Livewire\Catalogue\HomeCatalogs;
use App\Http\Livewire\Medicine\External\HomeMedicineExternal;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Validate\Qr as ValidateQr;
use App\Http\Livewire\Validate\UrlHome;
use App\Models\Catalogue\Headquarter;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('', [homeController::class, 'index'])->name('afac.home');
    Route::middleware(['role:super_admin|user|medicine_admin'])->group(function () {
        Route::get('/medicine', HomeMedicine::class)->name('afac.medicine');
        Route::get('/linguistics', HomeLinguistics::class)->name('afac.linguistics');
        Route::get('/download', [HomeMedicine::class, 'generatePdf'])->name('download');
    });
    Route::middleware(['role:super_admin|medicine_admin|super_admin_medicine|admin_medicine_v2|sub_headquarters|headquarters'])->group(function () {
        Route::get('/headquarters', HomeHeadquarter::class)->name('afac.headquarterMedicine');
        Route::get('/validate', ValidateQr::class)->name('validate');
        Route::get('/link/{keyEncrypt}', UrlHome::class)->name('validateUrl')->middleware('validate.encrypted.url');
    });
    Route::get('/appointments', [AppointmentMedicineController::class, 'index'])->name('afac.appointment');
    Route::get('/downloadFile/{scheduleId}', [AppointmentMedicineController::class, 'download'])->name('afac.downloadFile');
    Route::get('/users', [UserMedicineController::class, 'index'])->name('afac.users');
    Route::middleware(['role:super_admin'])->group(function () {
        Route::resource('/roles', RoleController::class)->names('afac.roles');
        Route::get('/historymedicine', HistoryMedicieMovements::class)->name('afac.medicienMovements');
        Route::get('/historylinguistics', HistoryLinguisticsMovements::class)->name('afac.linguisticsMovements');
        Route::get('/homecatalogs', HomeCatalogs::class)->name('afac.catalogappointment');
    });
});
