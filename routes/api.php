<?php

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\TopicController;
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


Route::get('get-all-sliders', [SliderController::class, 'index']);
Route::get('get-all-departments', [DepartmentController::class, 'index']);
Route::get('get-all-courses', [CourseController::class, 'index']);
Route::get('get-all-courses-by-departmentId/{id}', [CourseController::class, 'getAllCoursesByDepartmentId']);
Route::get('get-all-topics', [TopicController::class, 'index']);
Route::get('get-all-topics-by-courseId/{id}', [TopicController::class, 'getAllTopicsByCourseId']);


