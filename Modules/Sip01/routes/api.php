<?php

use Illuminate\Support\Facades\Route;
use Modules\Sip01\Http\Controllers\Sip01Controller;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('sip01s', Sip01Controller::class)->names('sip01');
});
