<?php

use App\Http\Controllers\Api\UbicacionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Ubicaciones
Route::get('/Ubicaciones', [UbicacionController::class, 'index']);

Route::get('/Ubicaciones/{id}', [UbicacionController::class, 'show']);

Route::post('/Ubicaciones', [UbicacionController::class, 'store']);

Route::put('/Ubicaciones/{id}', [UbicacionController::class, 'update']);

Route::patch('/Ubicaciones/{id}', [UbicacionController::class, 'updatePartial']);

Route::delete('/Ubicaciones/{id}', [UbicacionController::class, 'destroy']);
