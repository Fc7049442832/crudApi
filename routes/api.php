<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Fetch all contacts
Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');

// Fetch a single product
Route::get('contacts/{id}', [ContactController::class, 'show'])->name('contacts.show');

// Create a new product
Route::post('contacts', [ContactController::class, 'store'])->name('contacts.store');

// Update an existing product
Route::put('contacts/{id}', [ContactController::class, 'update'])->name('contacts.update');

// Delete a product
Route::delete('contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');