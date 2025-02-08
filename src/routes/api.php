<?php

use App\Http\Controllers\V1\CartDiscountController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'v1'], function () {
    Route::post('/calculate-discount', [CartDiscountController::class, 'calculate']);
});
