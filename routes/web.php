<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\AttendeeController;



Route::get('/',[EventController::class,'index']); 



/* Route::apiResource('events',EventController::class);
Route::apiResource('events.attendees', AttendeeController::class)->scoped(['attendee' => 'event']); */