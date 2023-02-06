<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (){
    return view('home');
})->name('home');

Route::get('/exam_start', [\App\Http\Controllers\ExamStartController::class, 'index'])->name('exam_start');

Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin_home')->middleware('auth');

Route::get('/admin/create_exam', [\App\Http\Controllers\AdminController::class, 'create_exam_page'])->name('create_exam_page')->middleware('auth');

Route::get('/admin/update_exam/{id}', [\App\Http\Controllers\AdminController::class, 'update_exam_page'])->name('update_exam_page')->middleware('auth');

Route::get('/admin/show_exam', [\App\Http\Controllers\AdminController::class, 'show_exam_page'])->name('show_exam')->middleware('auth');

Route::get('/admin/users', [\App\Http\Controllers\AdminController::class, 'show_users_page'])->name('users')->middleware('auth');

Route::post('/admin/logout', [\App\Http\Controllers\AdminController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/admin/users/{id}', [\App\Http\Controllers\UsersController::class, 'delete_user'])->name('delete_user');

Route::get('/admin/users/update/{id}', [\App\Http\Controllers\UsersController::class, 'update_users_page'])->name('update_users_page')->middleware('auth');

Route::post('/admin/update_exam', [\App\Http\Controllers\AdminController::class, 'update_exam'])->name('update_exam');

Route::post('/admin/users/update', [\App\Http\Controllers\UsersController::class, 'update_users'])->name('update_users');

Route::post('/', [\App\Http\Controllers\UsersController::class, 'login'])->name('login');

Route::post('/admin/create_exam', [\App\Http\Controllers\AdminController::class, 'create_exam'])->name('create_exam')->middleware('auth');

Route::post('/admin/users/registration', [\App\Http\Controllers\UsersController::class, 'registration'])->name('registration_user_form');
