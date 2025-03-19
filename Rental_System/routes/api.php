<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PropertyController;
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

Route::post('auth/register',[AuthController::class,'register']);
Route::post('auth/login',[AuthController::class,'login']);


Route::get('/getAllProperties',[PropertyController::class,'getAllProperties']);
Route::post('/addProperty',[PropertyController::class,'addProperties']);

Route::get('/getAllOwners',[OwnerController::class,'getAllOwners']);
Route::post('/getOwnerProperties',[OwnerController::class,'getOwnerProperties']);
