<?php

use Illuminate\Support\Facades\Route;
use Modules\Sib01\Http\Controllers\Sib01Controller;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('sib01s', Sib01Controller::class)->names('sib01');
});
