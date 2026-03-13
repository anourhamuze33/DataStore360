<?php

use App\Http\Controllers\AiController;
use App\Http\Controllers\PatientController;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/patients', [PatientController::class, 'index']);
Route::get('/patients/{patient}', [PatientController::class, 'show']);
Route::post('/patients/store', [PatientController::class, 'store']);
Route::put('/patients/{patient}', [PatientController::class, 'update']);
Route::delete('/patients/{patient}', [PatientController::class, 'destroy']);

Route::get('/resume/{patient}', [AiController::class, 'generateResume']);