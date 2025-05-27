<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainController;

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


//Admin
Route::get('/adminarea/login', function () {
    return view('/adminarea/login');
});
Route::post('/adminloginok', [MemberController::class, 'adminloginok']) -> name('admin.loginok');
Route::get('/adminarea', [AdminController::class, 'index'])->name('adminarea.index');

//test
Route::get('/elatest', [AdminController::class, 'elatest'])->name('adminarea.elatest');

//main
Route::get('/', [MainController::class, 'index'])->name('main.index');
