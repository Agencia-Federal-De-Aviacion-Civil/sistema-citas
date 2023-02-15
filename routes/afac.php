<?php

use App\Http\Controllers\afac\homeController;
use App\Http\Livewire\Appointment\AppointmentHistory;
use App\Http\Livewire\Appointment\Generate;
use App\Http\Livewire\Appointment\Headquarters\Headquarters;
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
Route::get('', [homeController::class, 'index'])->name('afac.home');
Route::group(['middleware' => ['role:admin']], function () {
    Route::get('appointments', AppointmentHistory::class)->name('afac.appointment');
    Route::get('headquarters', Headquarters::class)->name('afac.headquarters');
});
Route::get('/download', [Generate::class, 'test'])->name('download');
Route::get('/downloads', [AppointmentHistory::class, 'test'])->name('downloads');
