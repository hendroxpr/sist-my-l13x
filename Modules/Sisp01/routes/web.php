<?php

use Illuminate\Support\Facades\Route;
use Modules\Sisp01\Http\Controllers\Sisp01Controller;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('sisp01s', Sisp01Controller::class)->names('sisp01');
});
