<?php

use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/UploadCenter',UploadController::class)->parameters(['UploadCenter'=>'id']);
