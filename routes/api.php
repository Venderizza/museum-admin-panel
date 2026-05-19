<?php

use App\Http\Controllers\ScanResultController;
use Illuminate\Support\Facades\Route;

Route::post('/scans/{page}/result', [ScanResultController::class,'receive']);