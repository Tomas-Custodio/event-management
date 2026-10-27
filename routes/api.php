<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\AttendeeController;
use App\Http\Controllers\Api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user(); 
    })->middleware('auth:sanctum');

/* 
Route::get('/events',[EventController::class,'index']); */


Route::Post('login',[ AuthController::class,'login']);

Route::middleware(['auth:sanctum','throttle:3,1'])->group(function(){

    Route::apiResource('events', EventController::class );
    Route::apiResource('events.attendees', AttendeeController::class)->scoped();

    Route::Post('logout',[ AuthController::class,'logout']);

});
