<?php

use App\Http\Controllers\afac\homeController;
use App\Http\Controllers\afac\schedule\IndexController;
use App\Http\Controllers\afac\schedule\userMedicine;
use App\Http\Controllers\RoleController;
use App\Http\Livewire\Headquarters\HomeHeadquarter;
use App\Http\Livewire\Linguistics\HomeLinguistics;
use App\Http\Livewire\Register\Peoplehistoryrecords;
use App\Http\Livewire\Medicine\HomeMedicine;
use App\Http\Livewire\Medicine\ScheduleAppointment;
use App\Http\Livewire\Medicine\HistoryMedicieMovements;
use App\Http\Livewire\Medicine\CalendarAppointment;
use App\Http\Livewire\Linguistics\HistoryLinguisticsMovements;
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
    Route::middleware(['role:super_admin|medicine_admin|super_admin_medicine'])->group(function () {
        Route::get('/headquarters', HomeHeadquarter::class)->name('afac.headquarterMedicine');
        Route::get('/register', Peoplehistoryrecords::class)->name('afac.historyRegister');
        Route::get('/validate', ValidateQr::class)->name('validate');
        Route::get('/historymedicine', HistoryMedicieMovements::class)->name('afac.medicienMovements');
        Route::get('/historylinguistics', HistoryLinguisticsMovements::class)->name('afac.linguisticsMovements');
        Route::get('/calendar', CalendarAppointment::class)->name('afac.calendar');
    });
    Route::get('/appointments', [IndexController::class, 'index'])->name('afac.appointment');
    Route::get('/users', [userMedicine::class, 'index'])->name('afac.users');
    Route::get('/downloadFile/{scheduleId}', [IndexController::class, 'download'])->name('afac.downloadFile');
    Route::get('/schedule', ScheduleAppointment::class)->name('afac.schedule');
    Route::resource('/roles', RoleController::class)->names('afac.roles');
});
