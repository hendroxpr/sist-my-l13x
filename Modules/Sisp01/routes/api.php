<?php

use Illuminate\Support\Facades\Route;
use Modules\Sisp01\Http\Controllers\Sisp01Controller;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('sisp01s', Sisp01Controller::class)->names('sisp01');
});
