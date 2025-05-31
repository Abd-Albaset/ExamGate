<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SubjectController;
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


Route::get('subjects', [SubjectController::class, 'index']);
Route::get('subjects/{subject}', [SubjectController::class, 'show']);

Route::middleware(['auth:api', 'role:instructor'])->group(function () {
    Route::post('subjects', [SubjectController::class, 'store']);
    Route::put('subjects/{subject}', [SubjectController::class, 'update']);
    Route::delete('subjects/{subject}', [SubjectController::class, 'destroy']);
});

Route::get('questions', [QuestionController::class, 'index']);
Route::get('questions/{question}', [QuestionController::class, 'show']);

Route::middleware(['auth:api', 'role:instructor'])->group(function () {
    Route::post('questions', [QuestionController::class, 'store']);
    Route::post('questions/{question}', [QuestionController::class, 'update']);
    Route::delete('questions/{question}', [QuestionController::class, 'destroy']);
});

Route::get('answers', [AnswerController::class, 'index']);
Route::get('answers/{answer}', [AnswerController::class, 'show']);

Route::middleware(['auth:api', 'role:instructor'])->group(function () {
    Route::post('answers', [AnswerController::class, 'store']);
    Route::put('answers/{answer}', [AnswerController::class, 'update']);
    Route::delete('answers/{answer}', [AnswerController::class, 'destroy']);
});

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
