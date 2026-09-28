<?php

use Illuminate\Support\Facades\Route;
use Modules\Sibm01\Http\Controllers\Sibm01Controller;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('sibm01s', Sibm01Controller::class)->names('sibm01');
});
