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

Route::controller(\App\Http\Controllers\UsersController::class)->group(function (){
    Route::post('/login', 'login')->name('login');
    Route::post('/', 'registration')->name('registration');
    Route::get('/admin/logout', 'logout')->name('logout');
});

Route::controller(\App\Http\Controllers\AdminPanelSuperUserController::class)->group(function (){
   Route::get('/admin', 'index')->name('admin_panel_su');
   Route::get('/admin/users', 'show_users')->name('admin_panel_su_show_users');
   Route::get('/admin/exam', 'show_exam')->name('admin_panel_su_show_exam');
   Route::get('/admin/exam/{id}', 'question_topic_and_question_page')->name('question_topic_and_question_page');
   Route::get('/admin/link_exam', 'show_link_exam')->name('admin_panel_su_link_exam');
   Route::get('/admin/result_exam', 'show_result_exam')->name('admin_panel_us_show_result_exam');
   Route::get('/admin/users/{id}/update', 'update_users_page')->name('admin_panel_su_update_users_page');
   Route::get('/admin/link_exam/{id}/update', 'update_link_exam_page')->name('admin_panel_su_update_link_exam_page');
   Route::get('/admin/link_exam/delete/{id}', 'delete_link_exam')->name('admin_panel_su_delete_link_exam');

   Route::post('/admin/users', 'add_users')->name('add_user');
   Route::post('/admin/users/{id}/update', 'update_users')->name('update_users');
   Route::post('/admin/exam', 'add_exam')->name('admin_panel_su_add_exam');
   Route::post('/admin/link_exam', 'link_exam')->name('admin_panel_su_link_exam');
   Route::post('/admin/link_exam/{id}/update', 'update_link_exam')->name('admin_panel_su_update_link_exam');
});

Route::controller(\App\Http\Controllers\ExamStartController::class)->group(function (){
    Route::get('/exam_start/{id}', 'index')->name('exam_start');
});
