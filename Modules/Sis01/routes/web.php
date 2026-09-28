<?php

use Illuminate\Support\Facades\Route;
use Modules\Sis01\Http\Controllers\Sis01Controller;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('sis01s', Sis01Controller::class)->names('sis01');
});
