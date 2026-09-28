<?php

use Illuminate\Support\Facades\Route;
use Modules\Siinv01\Http\Controllers\Siinv01Controller;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('siinv01s', Siinv01Controller::class)->names('siinv01');
});
