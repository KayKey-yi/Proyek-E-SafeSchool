<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Roles\Controllers\RolesController;

Route::controller(RolesController::class)->middleware(['web','auth'])->name('roles.')->group(function(){
	Route::get('/roles', 'index')->name('index');
	Route::get('/roles/data', 'data')->name('data.index');
	Route::get('/roles/create', 'create')->name('create');
	Route::post('/roles', 'store')->name('store');
	Route::get('/roles/{roles}', 'show')->name('show');
	Route::get('/roles/{roles}/edit', 'edit')->name('edit');
	Route::patch('/roles/{roles}', 'update')->name('update');
	Route::get('/roles/{roles}/delete', 'destroy')->name('destroy');
});
