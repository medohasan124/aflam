<?php

use App\Http\Controllers\Admin\dashboard;
use App\Http\Controllers\Admin\GenraContoller;
use App\Http\Controllers\Admin\MovieContoller;
use App\Http\Controllers\Admin\ProfileContoller;
use App\Http\Controllers\Admin\role;

use App\Http\Controllers\Admin\User;
use App\Http\Controllers\Admin\UserContoller;

use App\Http\Controllers\Admin\settingContoller;
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
     'auth',
    // 'role:SuperAdmin|Admin'
])
->prefix(LaravelLocalization::setLocale())
->group(function(){


    Route::name('admin.')
            ->prefix('admin')
            ->group(function(){

                Route::resource('dashboard', dashboard::class)->names('dashbaord');
                Route::delete('roles/bulckDelete',[role::class, 'bulckDelete'])->name('roles.bulckDelete');
                Route::resource('roles', role::class)->names('roles');





                Route::get('users/data', [UserContoller::class, 'data'])->name('users.data');
                Route::delete('users/bulckDelete',[UserContoller::class, 'bulckDelete'])->name('users.bulckDelete');
                Route::resource('users', UserContoller::class)->names('users');


                Route::get('genra/data', [GenraContoller::class, 'data'])->name('genra.data');
                Route::delete('genra/bulckDelete',[GenraContoller::class, 'bulckDelete'])->name('genra.bulckDelete');
                Route::resource('genra', GenraContoller::class)->names('genra');


                Route::get('movie/data', [movieContoller::class, 'data'])->name('movie.data');
                Route::delete('movie/bulckDelete',[movieContoller::class, 'bulckDelete'])->name('movie.bulckDelete');
                Route::resource('movie', movieContoller::class)->names('movie');


                Route::resource('setting', settingContoller::class)->names('setting');
                Route::resource('profile',  ProfileContoller::class)->names('profile');




            });
});

