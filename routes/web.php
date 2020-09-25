<?php

use Illuminate\Support\Facades\Route;
use App\Models\Students;
use App\Models\Subject;
use App\Models\Mark;
use Illuminate\Http\Request;
use App\Http\Controllers\MainController;

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
// GET
Route::get('/',[MainController::Class,'index'] )->name('home');
Route::get('/first_module',[MainController::Class,'view_first_module'])->name('first.module');
Route::get('/first_module/data',[MainController::class,'insert_mark_list'])->name('get.first.module');
Route::get('/student/delete/{id}',[MainController::Class,'student_delete'])->name('studentDelete');
Route::get('/subject/delete/{id}',[MainController::Class,'subject_delete'])->name('subjectDelete');
Route::get('/subject/edit/{id}',[MainController::Class,'subject_edit'])->name('subjectEdit');
Route::get('/student/edit/{id}',[MainController::Class,'student_edit'])->name('studentEdit');
Route::get('/mark_table',[MainController::Class,'mark_table'])->name('markTable');
Route::get('/mark_table/date',[MainController::Class,'get_mark_table'])->name('get.markTable');

// POST
Route::post('/add_student',[MainController::Class,'add_student'])->name('add.student');
Route::post('/add_subject',[MainController::Class,'add_subject'])->name('add.subject');
Route::post('/test',[MainController::class,'post_first_module'])->name('first.module.post');
Route::post('/student/edit/{id}',[MainController::Class,'post_student_edit'])->name('post.studentEdit');
Route::post('/subject/edit/',[MainController::Class,'post_subject_edit'])->name('post.editSubject');





