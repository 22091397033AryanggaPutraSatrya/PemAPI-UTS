<?php

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

// Contact Routes
Route::post('/api/contacts', [\App\Http\Controllers\ContactController::class, 'store']);
Route::get('/api/contacts', [\App\Http\Controllers\ContactController::class, 'index']);
Route::get('/api/contacts/{id}', [\App\Http\Controllers\ContactController::class, 'show']);
Route::put('/api/contacts/{id}', [\App\Http\Controllers\ContactController::class, 'update']);
Route::delete('/api/contacts/{id}', [\App\Http\Controllers\ContactController::class, 'destroy']);

// Address Routes
Route::post('/api/contacts/{idContact}/addresses', [\App\Http\Controllers\AddressController::class, 'store']);
Route::get('/api/contacts/{idContact}/addresses', [\App\Http\Controllers\AddressController::class, 'index']);
Route::get('/api/contacts/{idContact}/addresses/{idAddress}', [\App\Http\Controllers\AddressController::class, 'show']);
Route::put('/api/contacts/{idContact}/addresses/{idAddress}', [\App\Http\Controllers\AddressController::class, 'update']);
Route::delete('/api/contacts/{idContact}/addresses/{idAddress}', [\App\Http\Controllers\AddressController::class, 'destroy']);
