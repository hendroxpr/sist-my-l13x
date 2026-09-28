<?php

use Illuminate\Support\Facades\Route;
use Modules\Sip01\Http\Controllers\Sip01Controller;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('sip01s', Sip01Controller::class)->names('sip01');
});
