<?php

use Illuminate\Support\Facades\Route;
use Modules\Pos01\Http\Controllers\Pos01Controller;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('pos01s', Pos01Controller::class)->names('pos01');
});
