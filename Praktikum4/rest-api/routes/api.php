<?php

use App\Http\Controllers\AnimalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Untuk Menampilkan Data
Route::get('/animals', [AnimalController::class, 'index']);

// Untuk Menambah Data
Route::post('/animals/store', [AnimalController::class, 'store']);

// Untuk Mengupdate Data
Route::put('/animals/{id}', [AnimalController::class, 'update']);

// Untuk Menghapus Data
Route::delete('/animals/{id}', [AnimalController::class, 'destroy']);