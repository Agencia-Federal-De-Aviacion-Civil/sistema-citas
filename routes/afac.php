<?php

use App\Http\Controllers\afac\homeController;
use App\Http\Livewire\Appointment\Generate;
use App\Http\Livewire\Appointment\Headquarters\Headquarters;
use App\Http\Livewire\Home\Dashboard;
use App\Http\Livewire\Medicine\HistoryAppointment;
use App\Http\Livewire\Medicine\HomeMedicine;
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

Route::get('', Dashboard::class)->name('afac.home');
Route::group(['middleware' => ['role:super_admin|user']], function () {
    Route::get('/medicine', HomeMedicine::class)->name('afac.medicine');
    Route::get('/download', [HomeMedicine::class, 'test'])->name('download');
});
// Route::group(['middleware' => ['role:admin|headquarters']], function () {
//     Route::get('appointments', AppointmentHistory::class)->name('afac.appointment');
// });
Route::group(['middleware' => ['role:super_admin']], function () {
    Route::get('headquarters', Headquarters::class)->name('afac.headquarterMedicine');
    Route::get('appointments', HistoryAppointment::class)->name('afac.historyMedicine');
});
// Route::get('/downloads', [AppointmentHistory::class, 'test'])->name('downloads');
