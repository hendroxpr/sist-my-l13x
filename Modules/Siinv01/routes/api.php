<?php

use Illuminate\Support\Facades\Route;
use Modules\Siinv01\Http\Controllers\Siinv01Controller;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('siinv01s', Siinv01Controller::class)->names('siinv01');
});
