<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('pets', PetController::class);
Route::post('pets/{id}/upload-image', [PetController::class, 'uploadImage'])->name('pets.upload-image');
