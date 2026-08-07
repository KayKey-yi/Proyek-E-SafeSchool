<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Complaints\Controllers\ComplaintsController;

Route::controller(ComplaintsController::class)->middleware(['web','auth'])->name('complaints.')->group(function(){
	Route::get('/complaints', 'index')->name('index');
	Route::get('/complaints/data', 'data')->name('data.index');
	Route::get('/complaints/create', 'create')->name('create');
	Route::post('/complaints', 'store')->name('store');
	Route::get('/complaints/{complaints}', 'show')->name('show');
	Route::get('/complaints/{complaints}/edit', 'edit')->name('edit');
	Route::patch('/complaints/{complaints}', 'update')->name('update');
	Route::get('/complaints/{complaints}/delete', 'destroy')->name('destroy');
});
