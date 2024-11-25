<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\Medicine\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware([
    // 'auth:sanctum',
])->group(function () {
    //API ROUTES TEST
    Route::post('/register', [LoginController::class, 'register']);
    Route::post('/login', [LoginController::class, 'login']);



    Route::get('/list-users', [UsersController::class, 'list']);
    Route::get('/users-curp', [UsersController::class, 'listCurp']);
    Route::post('/list-usersId', [UsersController::class, 'listUserId']);
    Route::post('/list-usersCurp', [UsersController::class, 'listUserCurp']);
    Route::post('/list-headquarters', [UsersController::class, 'listHeadquarter']);
    Route::put('/update-reserves/{id}', [UsersController::class, 'update']);
    Route::put('/update-status/{ids}', [UsersController::class, 'updateStatus']);
    Route::put('/update-status-extension/{id}', [UsersController::class, 'updateStatusExtension']);

    Route::get('/reserves', [UsersController::class, 'listReserves']);
});

Route::get('/statusCita', [UsersController::class, 'status']);
Route::get('/userUpdate', [UsersController::class, 'userUpdate']);

