<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'index'])->name('front.index');

Auth::routes(['register' => false, 'reset' => false]);

Route::prefix('admin')
     ->name('admin.')
     ->middleware('auth')
     ->group(static function () {
         Route::resource('company', CompanyController::class);
         Route::resource('employee', EmployeeController::class);
     });
