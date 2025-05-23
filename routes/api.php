<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SubjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::resource('subjects', SubjectController::class)->except(['create', 'edit']);
Route::resource('questions', QuestionController::class)->except(['create', 'edit']);
Route::resource('answers', AnswerController::class)->except(['create', 'edit']);

Route::post('register',[AuthController::class,'register']);
Route::post('login', [AuthController::class,'login']);
Route::post('refresh', [AuthController::class,'refresh']);
Route::post('logout', [AuthController::class,'logout'])->middleware('auth:api');

Route::middleware('auth:api')->prefix('exams')->group(function (){
    Route::get('/',[ExamController::class,'index']);
    Route::get('/{subject:name}/{session}',[ExamController::class,'getExamData']);
    Route::post('/{subject:name}/{session}',[ExamController::class,'marksEvaluate']);
});

Route::middleware(['auth:api', 'role:admin'])->prefix('admin')->group(function (){
    Route::get('/addInstructor/{user}',[AdminController::class,'addInstructor']);
    Route::get('/roleReset/{user}',[AdminController::class,'roleReset']);
});
