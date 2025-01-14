<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/blog', [BlogController::class,'index'])->middleware('auth:sanctum');
