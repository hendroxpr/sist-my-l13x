<?php

use Illuminate\Support\Facades\Route;
use Modules\Pos01\Http\Controllers\Pos01Controller;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('pos01s', Pos01Controller::class)->names('pos01');
});
