<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\CboardController;

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

//member
Route::get('/member/signup', [MemberController::class, 'signup'])->name('member.signup');
Route::POST('/member/signupok', [MemberController::class, 'signupok'])->name('member.signupok');
Route::get('/member/login', [MemberController::class, 'login'])->name('member.login');
Route::POST('/member/loginok', [MemberController::class, 'loginok'])->name('member.loginok');
Route::get('/member/logout', [MemberController::class, 'logout'])->name('member.logout');

//board
Route::get('/boards', [CboardController::class, 'index'])->name('boards.index');
Route::get('/boards/show/{id}/{page}', [CboardController::class, 'show'])->name('boards.show');
Route::get('/boards/write/{multi}/{bid?}', [CboardController::class, 'write'])->name('boards.write');
Route::get('/boards/summernote/{multi}/{bid?}', [CboardController::class, 'summernote'])->name('boards.summernote');
Route::post('/boards/create', [CboardController::class, 'create'])->name('boards.create');
Route::post('/boards/saveimage', [CboardController::class, 'saveimage'])->name('boards.saveimage');