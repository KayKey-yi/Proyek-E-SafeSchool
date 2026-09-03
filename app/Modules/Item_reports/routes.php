<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Item_reports\Controllers\Item_reportsController;

Route::controller(Item_reportsController::class)->middleware(['web','auth'])->name('item_reports.')->group(function(){
	Route::get('/lost-and-found', 'userIndex')->name('user.index');
	Route::get('/lost-and-found/lapor', 'userCreate')->name('user.create');
	Route::post('/lost-and-found/lapor', 'userStore')->name('user.store');
	Route::get('/lost-and-found/diterima', 'userSuccess')->name('user.success');
	Route::get('/item_reports', 'index')->name('index');
	Route::get('/item_reports/data', 'data')->name('data.index');
	Route::get('/item_reports/create', 'create')->name('create');
	Route::post('/item_reports', 'store')->name('store');
	Route::get('/item_reports/{item_reports}', 'show')->name('show');
	Route::get('/item_reports/{item_reports}/edit', 'edit')->name('edit');
	Route::patch('/item_reports/{item_reports}', 'update')->name('update');
	Route::get('/item_reports/{item_reports}/delete', 'destroy')->name('destroy');
});
