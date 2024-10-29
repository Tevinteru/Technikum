<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\LogController;

Route::resource('teachers', TeacherController::class);
Route::resource('students', StudentController::class);

Route::delete('/truncate-table-teachers', [DatabaseController::class, 'truncateTableTeachers'])->name('truncate.table.teachers');
Route::delete('/truncate-table-students', [DatabaseController::class, 'truncateTableStudents'])->name('truncate.table.students');
Route::post('/seed-database-teachers', [DatabaseController::class, 'seedDatabaseTeachers'])->name('seed.database.teachers');
Route::post('/seed-database-students', [DatabaseController::class, 'seedDatabaseStudents'])->name('seed.database.students');

Route::get('teachers/export/excel', [TeacherController::class, 'exportTeachers'])->name('export.teachers');

Route::get('students/export/excel', [StudentController::class, 'exportStudents'])->name('export.students');

Route::get('/excel-form', [ExcelController::class, 'showForm'])->name('excel.form');
Route::post('/excel-form', [ExcelController::class, 'handleForm']);
Route::get('/download-excel', [ExcelController::class, 'downloadExcel']);

Route::get('/generate-statement/{student}', [DocumentController::class, 'generateStatement']);
Route::post('/generate-statement', [DocumentController::class, 'generateStatement'])->name('generate.statement');
Route::get('/download-report', [ReportController::class, 'generateReport'])->name('report');
Route::get('/download-report2', [ReportController::class, 'generateReport2'])->name('report2');

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::get('/download-today-logs', [LogController::class, 'downloadTodayLogs'])->name('download.today.logs');