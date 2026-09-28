<?php

use Illuminate\Support\Facades\Route;
use Modules\Sipp01\Http\Controllers\Sipp01Controller;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('sipp01s', Sipp01Controller::class)->names('sipp01');
});
