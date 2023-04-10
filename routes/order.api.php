<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/order', [OrderController::class, 'index']);
Route::post('/order', [OrderController::class, 'create']);
?>
