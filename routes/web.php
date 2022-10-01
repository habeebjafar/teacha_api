<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TopicController;


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

Route::get('/', function () {
    return view('welcome');
});

//departments

Route::get('dashboard', [DashboardController::class, 'index'])->name('mydashboard');
Route::get('get-all-departments', [DepartmentController::class, 'index']);
Route::get('add-department-form', [DepartmentController::class, 'create']);
Route::post('post-department-form', [DepartmentController::class, 'store']);
Route::get('edit-department/{id}', [DepartmentController::class, 'edit']);
Route::post('update-department-form/{id}', [DepartmentController::class, 'update']);

//sliders

Route::get('get-slider-form', [SliderController::class, 'create']);
Route::post('post-slider-form', [SliderController::class, 'store']);
Route::get('all-sliders', [SliderController::class, 'index']);
Route::get('edit-slider/{id}', [SliderController::class, 'edit']);
Route::post('update-slider-form/{id}', [SliderController::class, 'update']);
Route::get('delete-slider/{id}', [SliderController::class, 'destroy']);

//courses

Route::get('get-course-form', [CourseController::class, 'create']);
Route::post('post-course-form', [CourseController::class, 'store']);
Route::get('get-all-courses', [CourseController::class, 'index']);
Route::get('edit-course/{id}', [CourseController::class, 'edit']);
Route::post('update-course-form/{id}', [CourseController::class, 'update']);
Route::get('delete-slider/{id}', [SliderController::class, 'destroy']);


//Topics

Route::get('get-topic-form', [TopicController::class, 'create']);
Route::post('post-topic-form', [TopicController::class, 'store']);
Route::get('get-all-topics', [TopicController::class, 'index']);
Route::get('edit-topic/{id}', [TopicController::class, 'edit']);
Route::get('get-course-by-department/{id}', [TopicController::class, 'getCourseByDepartment']);
Route::get('get-course-by-department_update/{id}', [TopicController::class, 'getCourseByDepartmentUpdate']);

Route::post('update-topic-form/{id}', [TopicController::class, 'update']);
Route::get('delete-slider/{id}', [SliderController::class, 'destroy']);

