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
Route::get('requestVendor', 'App\Http\Controllers\API\vendorApiController@requestVendor');
Route::get('requestEquipment', 'App\Http\Controllers\API\vendorApiController@requestEquipment');

Route::post('saveVendor', 'App\Http\Controllers\API\vendorApiController@saveVendor');
Route::post('saveEquipment', 'App\Http\Controllers\API\vendorApiController@saveEquipment');
