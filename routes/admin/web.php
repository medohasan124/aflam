<?php

use App\Http\Controllers\Admin\dashboard;
use App\Http\Controllers\Admin\role;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware([
    'localeSessionRedirect',
    'localizationRedirect',
    'localeViewPath',
    // 'auth',
    // 'role:SuperAdmin|Admin'
])
->prefix(LaravelLocalization::setLocale())
->group(function(){
    Route::name('admin.')
            ->prefix('admin')
            ->group(function(){
                Route::resource('dashboard', dashboard::class)->names('dashbaord');
                Route::resource('roles', role::class)->names('roles');
                Route::post('roles/bulckDelete',[role::class, 'bulckDelete'])->name('roles.bulckDelete');

            });
});

