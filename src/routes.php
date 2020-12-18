<?php

use DinandMentink\Markdown\Http\Controllers\UploadController;

Route::prefix(config("nova-markdown.route-prefix"))
    ->name("nova-markdown.")
    ->middleware(config("nova-markdown.middleware"))
    ->group(function(){

        if(config("nova-markdown.uploads")) {
            Route::resource("uploads", UploadController::class)->only("store");
        }

    });
