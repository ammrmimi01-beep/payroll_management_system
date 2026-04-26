<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PayrollController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('departments', DepartmentController::class);
    Route::resource('employees', EmployeeController::class);
    
    Route::prefix('payroll')->group(function () {
        Route::get('/run', [PayrollController::class, 'index'])->name('payroll.run');
        Route::post('/run', [PayrollController::class, 'run']);
        Route::get('/history', [PayrollController::class, 'history'])->name('payroll.history');
        Route::get('/{id}', [PayrollController::class, 'show'])->name('payroll.show');
    });
});



require __DIR__.'/auth.php';
