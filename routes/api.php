<?php

use App\Http\Controllers\API\FormController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// API Version 1
Route::prefix('v1')->group(function () {
    Route::get('/forms', [FormController::class, 'index']);
    Route::post('/forms/{templateId}', [FormController::class, 'store'])
        ->whereNumber('templateId');
});

// Fallback route for 404 errors
Route::fallback(function () {
    return response()->json([
        'success' => false,
        'message' => 'Endpoint not found',
        'error' => 'The requested API endpoint does not exist'
    ], 404);
});

