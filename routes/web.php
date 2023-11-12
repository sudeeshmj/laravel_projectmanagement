<?php

use App\Http\Controllers\ProjectController;
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



Route::get('/',[ProjectController::class,'projectList'])->name('dashboard');

Route::get('projects',[ProjectController::class,'projectList'])->name('project.list');
Route::get('tasks',[ProjectController::class,'taskList'])->name('task.list');
Route::get('timelogs',[ProjectController::class,'timeLogs'])->name('time.logs');
Route::post('save-data',[ProjectController::class,'saveData'])->name('save.data');
Route::post('fetch-task',[ProjectController::class,'fetchTask'])->name('fetch.task');

Route::get('report',[ProjectController::class,'report'])->name('report');
Route::get('fetch-data',[ProjectController::class,'fetchdata'])->name('fetch.data');
Route::get('search-data',[ProjectController::class,'searchData'])->name('search.data');
