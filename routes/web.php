<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/report', function () {
    return view('report-form');
});

Route::post('/report', [ReportController::class, 'generateReport'])->name('report.generate');
