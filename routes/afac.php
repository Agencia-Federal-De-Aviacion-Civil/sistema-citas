<?php

use App\Http\Controllers\afac\homeController;
use App\Http\Controllers\afac\schedule\IndexController;
use App\Http\Livewire\Appointment\Generate;
use App\Http\Livewire\Appointment\Headquarters\Headquarters;
use App\Http\Livewire\Home\Dashboard;
use App\Http\Livewire\Linguistics\HomeLinguistics;
use App\Http\Livewire\Medicine\HistoryAppointment;
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
Route::group(['middleware' => ['role:super_admin|user']], function () {
    Route::get('/medicine', HomeMedicine::class)->name('afac.medicine');
    Route::get('/linguistics', HomeLinguistics::class)->name('afac.linguistics');
    Route::get('/download', [HomeMedicine::class, 'generatePdf'])->name('download');
});
// TODO
Route::group(['middleware' => ['role:super_admin|medicine_admin']], function () {
    Route::get('headquarters', Headquarters::class)->name('afac.headquarterMedicine');
    Route::get('/register', Peoplehistoryrecords::class)->name('afac.historyRegister');
    Route::get('/validate', ValidateQr::class)->name('validate');
});
Route::get('/appointments', [IndexController::class, 'index'])->name('afac.appointment');
// Route::get('/downloads', [AppointmentHistory::class, 'test'])->name('downloads');
