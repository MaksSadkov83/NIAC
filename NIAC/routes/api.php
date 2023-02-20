<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'admin/exam/topic' => \App\Http\Controllers\Api\CreateQuestionTopicsWithQuestionController::class,
    'admin/exam/topic/question/option' => \App\Http\Controllers\Api\AddOptionToQuestion::class,
    'exam_start' => \App\Http\Controllers\Api\ExamStartController::class,
]);
