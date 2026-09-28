<?php

use Illuminate\Support\Facades\Route;
use Modules\Evot01\Http\Controllers\Evot01Controller;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('evot01s', Evot01Controller::class)->names('evot01');
});
