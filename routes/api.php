<?php

use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;

Route::prefix('document')->controller(DocumentController::class)->group(function () {
    Route::get('show', 'show');
    Route::get('download', 'download');
});
