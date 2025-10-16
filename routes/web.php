<?php

use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/pdf', [PDFController::class, 'editAndPrintPDF']);

// return view('print.pdf', ['pdfUrl' => asset('storage/updated.pdf')]);