<?php

use App\Http\Controllers\ApiClientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/tokens/create', [ApiClientController::class, 'generate']);

Route::middleware('accessKey')->group(function () {
    Route::group(['prefix' => 'patients'], function () {
        Route::get('/', [\App\Http\Controllers\UserController::class, 'getAllPatients']);
        Route::get('/{patientId}', [\App\Http\Controllers\UserController::class, 'getPatientById']);
        Route::post('/', [\App\Http\Controllers\UserController::class, 'createPatient']);
        Route::put('/{patientId}', [\App\Http\Controllers\UserController::class, 'updatePatient']);
        Route::delete('/{id}', [\App\Http\Controllers\UserController::class, 'deletePatient']);
    });
});
