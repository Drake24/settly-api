<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticateController;
use App\Http\Controllers\ClientController;

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


Route::post('authenticate', [AuthenticateController::class, 'authenticate']);
Route::apiResource('admins', AdminController::class);

Route::group(['middleware' => 'auth:api'], function () {

    Route::apiResource('clients', ClientController::class);
    // Know issue for Laravel/Symfony https://laracasts.com/discuss/channels/requests/patch-requests-with-form-data-parameters-are-not-recognized
    // Patch and Put. To be able to update, Post method is used so
    // that form-data can properly be sent.
    Route::post('clients/update/{id}', [ClientController::class, 'update']);
});
