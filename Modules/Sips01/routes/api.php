<?php

use Illuminate\Support\Facades\Route;
use Modules\Sips01\Http\Controllers\Sips01Controller;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('sips01s', Sips01Controller::class)->names('sips01');
});
