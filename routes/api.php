<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Blogcontroller;

Route::get('/blog', [Blogcontroller::class,'index'])->middleware('auth:sanctum');
