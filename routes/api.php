<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\MascotaController;

// Rutas públicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas por JWT (auth:api)
Route::middleware(['auth:api'])->group(function () {
    // Usuario autenticado
    Route::get('/user', [AuthController::class, 'me']);

    // Consulta avanzada: Usuarios con sus mascotas
    Route::get('/users/{id}/with-pets', function($id) {
        return App\Models\User::with('mascotas')->findOrFail($id);
    });

    // CRUD Mascotas
    Route::apiResource('mascotas', MascotaController::class);
});

