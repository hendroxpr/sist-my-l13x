<?php

use Illuminate\Support\Facades\Route;
use Modules\Sibm01\Http\Controllers\Sibm01Controller;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('sibm01s', Sibm01Controller::class)->names('sibm01');
});
