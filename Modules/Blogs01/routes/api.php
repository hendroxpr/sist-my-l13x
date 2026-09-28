<?php

use Illuminate\Support\Facades\Route;
use Modules\Blogs01\Http\Controllers\Blogs01Controller;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('blogs01s', Blogs01Controller::class)->names('blogs01');
});
