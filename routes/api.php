<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthorController;


Route::apiResource('v1/books', \App\Http\Controllers\Api\V1\BookController::class)
    ->middleware('auth:api');

Route::post('v1/register', [AuthorController::class, 'register']);
Route::post('v1/login', [AuthorController::class, 'login']);

Route::get('v1/profile', [AuthorController::class, 'profile'])
    ->middleware('auth:api');
Route::post('v1/logout', [AuthorController::class, 'logout'])
    ->middleware('auth:api');