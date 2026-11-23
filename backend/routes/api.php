<?php

use App\Http\Controllers\Api\ProjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes for PT SOSM Project Tracking Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/health', [ProjectController::class, 'health']);

// Main Project CRUD
Route::get('/projects', [ProjectController::class, 'index']);
Route::post('/projects', [ProjectController::class, 'store']);
Route::get('/projects/{id}', [ProjectController::class, 'show']);
Route::put('/projects/{id}', [ProjectController::class, 'update']);
Route::patch('/projects/{id}/toggle-stage', [ProjectController::class, 'toggleStage']);
Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);

// Bulk Sync & Reset to Excel Data
Route::post('/projects/bulk-sync', [ProjectController::class, 'bulkSync']);
Route::post('/reset', [ProjectController::class, 'reset']);
