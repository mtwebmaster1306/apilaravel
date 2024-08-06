<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\ApiBlueexpress;    
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


Route::post('/validate-license', [LicenseController::class, 'validateUserLicense']);
Route::get('/regions', [ApiBlueexpress::class, 'getRegions']);
Route::post('/calculate', [ApiBlueexpress::class, 'calculateShipment']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
