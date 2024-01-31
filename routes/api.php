<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\VisitorController;
use App\Models\Visitor;
use Illuminate\Support\Facades\DB;

Route::get('/sessions', [SessionController::class, 'index']);
Route::get('/visitor/{id}', [VisitorController::class, 'show']);
Route::post('/register/session', [VisitorController::class, 'registerToSession']);

Route::post('/session/store', [SessionController::class, 'store']);
Route::post('/visitor/store', [VisitorController::class, 'store']);
Route::post('/visitor/session/store', [VisitorController::class, 'registerToSession']);

