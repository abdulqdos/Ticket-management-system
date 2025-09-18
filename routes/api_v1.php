<?php


use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\V1\BookingController;
use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\EventController;
use App\Http\Controllers\Api\V1\ticketTypeController;

Route::prefix('v1')->as('api.v1.')->group(function () {
    Route::apiResource('customers', CustomerController::class)->only(["index" , "show"]);
    Route::apiResource('events', EventController::class)->only(["index" , "show"]);
    Route::apiResource('ticket-types', TicketTypeController::class)->only(["index" , "show"]);

    Route::middleware('auth:sanctum')->group(function () {
       Route::post('/events/{event}/ticket-types/{ticket_type}' , [BookingController::class , 'store'])->name('events.ticket-types.store'); // Booking ticket route
    });
});
