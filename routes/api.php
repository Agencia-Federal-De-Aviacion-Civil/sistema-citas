<?php

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
    Route::get('/list-users', [UsersController::class, 'list']);
    Route::get('/users-curp', [UsersController::class, 'listCurp']);
    Route::put('/update-reserves/{id}', [UsersController::class, 'update']);
});
