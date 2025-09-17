<?php


use App\Http\Controllers\Api\V1\CustomerController;

Route::prefix('v1')->as('api.v1.')->group(function () {
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/{customer}', [CustomerController::class, 'show'])->name('customers.show');
});
