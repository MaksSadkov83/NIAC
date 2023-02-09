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

Route::get('/admin', [\App\Http\Controllers\AdminPanelSuperUserController::class, 'index'])->name('admin_panel_super_user');

Route::get('/admin/users', [\App\Http\Controllers\AdminPanelSuperUserController::class, 'show_users'])->name('admin_panel_super_user_show_users');

Route::get('/admin/users/{id}/update', [\App\Http\Controllers\AdminPanelSuperUserController::class, 'update_users_page'])->name('admin_panel_super_user_update_users_form');

Route::get('/admin/examiner', [\App\Http\Controllers\AdminPanelExaminerController::class, 'index'])->name('admin_panel_examiner');

Route::get('/admin/examiner/users', [\App\Http\Controllers\AdminPanelExaminerController::class, 'show_user'])->name('admin_panel_examiner_show_users');

Route::get('/admin/examiner/users/{id}/update', [\App\Http\Controllers\AdminPanelExaminerController::class, 'update_users_page'])->name('admin_panel_examiner_update_user_show_form');

Route::get('/admin/examiner/exams', [\App\Http\Controllers\AdminPanelExaminerController::class, 'show_exam'])->name('show_exam');

Route::get('/admin/examiner/exams/{id}/update', [\App\Http\Controllers\AdminPanelExaminerController::class, 'update_exam_page'])->name('update_exam_page');

Route::get('/admin/logout', [\App\Http\Controllers\AdminPanelSuperUserController::class, 'logout'])->name('logout');

Route::post('/admin/examiner/users/{id}/update', [\App\Http\Controllers\AdminPanelExaminerController::class, 'update_examinee'])->name('update_examinee');

Route::post('/admin/examiner/exams', [\App\Http\Controllers\AdminPanelExaminerController::class, 'add_exam'])->name('add_exam');

Route::post('/admin/examiner/exams/{id}/update', [\App\Http\Controllers\AdminPanelExaminerController::class, 'update_exam'])->name('update_exam');

Route::post('/admin/examiner/users', [\App\Http\Controllers\AdminPanelExaminerController::class, 'add_examinee'])->name('add_examinee');

Route::post('/admin/users/{id}/update', [\App\Http\Controllers\AdminPanelSuperUserController::class, 'update_examiners'])->name('admin_panel_super_user_update_user');

Route::post('/login', [\App\Http\Controllers\UsersController::class, 'login'])->name('login');

Route::post('/', [\App\Http\Controllers\UsersController::class, 'registration'])->name('registration');

Route::post('/admin/users', [\App\Http\Controllers\AdminPanelSuperUserController::class, 'add_examiners'])->name('add_examiners');
