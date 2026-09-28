<?php

use Illuminate\Support\Facades\Route;
use Modules\Sipp01\Http\Controllers\Sipp01Controller;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('sipp01s', Sipp01Controller::class)->names('sipp01');
});
