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

Route::post('/admin/users/update/{id}', [\App\Http\Controllers\AdminPanelSuperUserController::class, ''])->name('admin_panel_super_user_update_users_form');

Route::post('/login', [\App\Http\Controllers\UsersController::class, 'login'])->name('login');

Route::post('/', [\App\Http\Controllers\UsersController::class, 'registration'])->name('registration');

Route::post('/admin/users', [\App\Http\Controllers\AdminPanelSuperUserController::class, 'add_examiners'])->name('add_examiners');
