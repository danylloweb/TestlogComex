<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::resource('products', ProductsController::class);
