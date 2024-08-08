<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\ApiBlueexpress;    
use App\Http\Controllers\ChilexpressController;    
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

Route::get('/chilexpress/origins', [ChilexpressController::class, 'getAllOrigins']);
Route::get('/chilexpress/regions', [ChilexpressController::class, 'getRegions']);
Route::get('/chilexpress/destinations/{regionCode}', [ChilexpressController::class, 'getDestinations']);
Route::post('/chilexpress/calculate-shipment', [ChilexpressController::class, 'calculateShipment']);
Route::post('/validate-license', [LicenseController::class, 'validateUserLicense']);
Route::get('/bluexpress/regions', [ApiBlueexpress::class, 'getRegions']);
Route::post('/bluexpress/calculate', [ApiBlueexpress::class, 'calculateShipment']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
