<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

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


Route::get('/student', [StudentController::class, 'index'])->name('student');
Route::get('/student/create', [StudentController::class, 'create'])->name('student.create');
Route::post('/student', [StudentController::class, 'store'])->name('student.store');
Route::get('/student/{id}', [StudentController::class, 'show'])->name('student.show');
Route::get('/studentEdit/{id}', [StudentController::class, 'edit'])->name('student.edit');
Route::patch('/student/{id}', [StudentController::class, 'update'])->name('student.update');
Route::delete('/student/{students}', [StudentController::class, 'destroy'])->name('student.destroy');
