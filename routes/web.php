<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dokumen-surat/{path}', function ($path) {
    if (!auth()->check()) { abort(403); } // Hanya yang login bisa lewat

    $fullPath = "surat_permohonan/" . $path;
    if (!Storage::disk('local')->exists($fullPath)) { abort(404); }

    return Storage::disk('local')->response($fullPath);
})->where('path', '.*')->name('surat.private');

Route::get('/titik-baliho/{path}', function ($path) {
    if (!auth()->check()) { abort(403); } // Hanya yang login bisa lewat

    $fullPath = "baliho/" . $path;
    if (!Storage::disk('local')->exists($fullPath)) { abort(404); }

    return Storage::disk('local')->response($fullPath);
})->where('path', '.*')->name('baliho.private');
