<?php

use Illuminate\Support\Facades\Route;
use App\Modules\report_statuses\Controllers\report_statusesController;

Route::controller(report_statusesController::class)->middleware(['web','auth'])->name('report_statuses.')->group(function(){
	Route::get('/report_statuses', 'index')->name('index');
	Route::get('/report_statuses/data', 'data')->name('data.index');
	Route::get('/report_statuses/create', 'create')->name('create');
	Route::post('/report_statuses', 'store')->name('store');
	Route::get('/report_statuses/{report_statuses}', 'show')->name('show');
	Route::get('/report_statuses/{report_statuses}/edit', 'edit')->name('edit');
	Route::patch('/report_statuses/{report_statuses}', 'update')->name('update');
	Route::get('/report_statuses/{report_statuses}/delete', 'destroy')->name('destroy');
});
