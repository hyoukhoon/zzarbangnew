<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;

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

Route::get('/', function () {
    return view('index');
});

//Admin
Route::get('/adminarea/login', function () {
    return view('/adminarea/login');
});
Route::post('/adminloginok', [MemberController::class, 'adminloginok']) -> name('admin.loginok');
Route::get('/adminarea', [AdminController::class, 'index'])->name('adminarea.index');
