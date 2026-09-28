<?php

use Illuminate\Support\Facades\Route;
use Modules\Sis01\Http\Controllers\Sis01Controller;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('sis01s', Sis01Controller::class)->names('sis01');
});
