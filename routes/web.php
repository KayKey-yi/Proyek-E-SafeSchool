<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'user.home')->name('frontend.index');

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/role/set/{id_role}', [DashboardController::class,'changeRole'])->name('dashboard.change.role');
    Route::get('/forcelogout', [DashboardController::class,'forceLogout'])->name('dashboard.force.logout');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
<<<<<<< HEAD
    
    Route::view('/laporanditerimaLF', 'auth.LaporanTerimaLF')->name('lost-found.report.received');
    
  

=======
>>>>>>> 5a0efc38113a7512ca47bc119ad637a54701f378
});


require __DIR__.'/auth.php';
