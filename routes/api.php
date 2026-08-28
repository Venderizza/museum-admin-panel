<?php

use App\Http\Controllers\ScanResultController;
use Illuminate\Support\Facades\Route;

Route::prefix('scans/{image_id}')->group(function(){
    Route::post('/status', [ScanResultController::class, 'updateStatus']);
    Route::post('/result', [ScanResultController::class, 'receive']);
});
