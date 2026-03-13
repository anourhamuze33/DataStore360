<?php

use App\Http\Controllers\ColocationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    });
    Route::get('/colocation/Premier', [ColocationController::class, 'premier'])->name('colocation.premier');
    Route::get('/colocation/form', [ColocationController::class, 'create'])->name('colocation.create');
    Route::post('/colocation/create', [ColocationController::class, 'store'])->name('colocation.store');
    Route::get('/colocation', [ColocationController::class, 'index'])->name('colocation.index');

    Route::get('/index', function () {
        return view('index');
    })->name('index');

    Route::get('/view3', function () {
        return view('Deponses.addDeponse');
    });
    

    Route::get('/inscription/form', [UserController::class, 'viewInscription'])->name('user.viewInscription');
    Route::post('/inscription', [UserController::class, 'inscription'])->name('user.inscription');
    
    Route::get('/login/form', [UserController::class, 'viewLogin'])->name('user.viewLogin');
    Route::post('/login', [UserController::class, 'login'])->name('user.login');
    
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
