<?php

use App\Http\Controllers\Api\Medicine\AuthController;
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
// Route::middleware([
//     // 'auth:sanctum',
// ])->group(function () {
//     //API ROUTES TEST
//     Route::get('/list-users', [UsersController::class, 'list']);
//     Route::get('/users-curp', [UsersController::class, 'listCurp']);
//     Route::post('/list-usersId', [UsersController::class, 'listUserId']);
//     Route::post('/list-headquarters', [UsersController::class, 'listHeadquarter']);
//     Route::put('/update-reserves/{id}', [UsersController::class, 'update']);
//     Route::put('/update-status/{ids}', [UsersController::class, 'updateStatus']);
//     Route::put('/update-status-extension/{id}', [UsersController::class, 'updateStatusExtension']);
// });

// TODO EndPoint para Iniciar Sesion (Lo Usa QR)
Route::post('/login-api', [AuthController::class, 'login']);

// TODO Protección de las Rutas con los Tokens
Route::middleware('jwt.verify')->group(function () {
    Route::get('/list-users', [UsersController::class, 'list']);
    Route::get('/users-curp', [UsersController::class, 'listCurp']);
    Route::post('/list-usersId', [UsersController::class, 'listUserId']);
    Route::post('/list-headquarters', [UsersController::class, 'listHeadquarter']);
    Route::put('/update-reserves/{id}', [UsersController::class, 'update']);
    Route::put('/update-status/{ids}', [UsersController::class, 'updateStatus']);
    Route::put('/update-status-extension/{id}', [UsersController::class, 'updateStatusExtension']);
});
