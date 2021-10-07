<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::prefix('v1')->middleware('apiJwt')->group(function(){
    
    Route::get('users', [UserController::class, 'index']);

});

Route::post('login'  , [AuthController::class, 'login']);
//Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');