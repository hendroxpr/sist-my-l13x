<?php

use Illuminate\Support\Facades\Route;
use Modules\Sib01\Http\Controllers\Sib01Controller;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('sib01s', Sib01Controller::class)->names('sib01');
});
