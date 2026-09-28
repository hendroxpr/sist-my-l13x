<?php

use Illuminate\Support\Facades\Route;
use Modules\Blogs01\Http\Controllers\Blogs01Controller;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('blogs01s', Blogs01Controller::class)->names('blogs01');
});
