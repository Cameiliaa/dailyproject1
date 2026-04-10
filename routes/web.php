<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
Route::get('/pdf/{file_id}', [PDFController::class, 'show']);
Route::post('/save-progress', [PDFController::class, 'saveProgress']);

Route::get('/pdf-file/{file_id}', [PDFController::class, 'getPDF']);
Route::get('/', function () {
    return view('welcome');
});

