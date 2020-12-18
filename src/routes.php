<?php

use DinandMentink\Markdown\Http\Controllers\UploadController;

Route::prefix(config("nova-markdown.route-prefix"))
    ->name("nova-markdown.")
    ->group(function(){

        Route::resource("uploads", UploadController::class)->only("store");

    });
