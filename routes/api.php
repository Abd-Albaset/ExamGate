<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SubjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', [Controller::class,'getCSRF']);

Route::resource('subjects', SubjectController::class)->except(['create', 'edit']);
Route::resource('questions', QuestionController::class)->except(['create', 'edit']);
Route::resource('answers', AnswerController::class)->except(['create', 'edit']);

Route::post('register',[AuthController::class,'register']);
Route::post('login', [AuthController::class,'login']);
Route::post('refresh', [AuthController::class,'refresh']);
Route::post('logout', [AuthController::class,'logout']);

Route::middleware('auth:api')->prefix('exams')->group(function (){
    Route::get('/',[ExamController::class,'index']);
    Route::get('/{subject:name}/{session}',[ExamController::class,'getExamData']);
    Route::post('/{subject:name}/{session}',[ExamController::class,'marksEvaluate']);
});

Route::middleware(['auth:api', 'role:admin'])->prefix('admin')->group(function (){
    Route::get('/addInstructor/{user}',[\App\Http\Controllers\AdminController::class,'addInstructor']);
    Route::get('/roleReset/{user}',[\App\Http\Controllers\AdminController::class,'roleReset']);
});
