<?php

use App\Http\Controllers\PatientsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route Patients
Route::get('/patients', [PatientsController::class, 'index']);
Route::post('/patients', [PatientsController::class, 'store']);
Route::get('/patients', [PatientsController::class, 'show']);
Route::put('/patients{id}', [PatientsController::class, 'update']);
Route::delete('/patients{id}', [PatientsController::class, 'destroy']);
Route::get('/patients/search{name}', [PatientsController::class, 'search']);
Route::get('/patients/status/positive', [PatientsController::class, 'positive']);
Route::get('/patients/status/recovered', [PatientsController::class, 'recovered']);
Route::get('/patients/status/dead', [PatientsController::class, 'dead']);
