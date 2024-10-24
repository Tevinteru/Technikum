<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class DatabaseController extends Controller
{
    public function truncateTableStudents()
    {
        // Удалите все записи из таблицы (замените 'your_table_name' на название вашей таблицы)
        DB::table('students')->truncate();

        return redirect()->back()->with('success', 'Все записи удалены.');
    }
    public function truncateTableTeachers()
    {
        // Удалите все записи из таблицы (замените 'your_table_name' на название вашей таблицы)
        DB::table('teachers')->truncate();

        return redirect()->back()->with('success', 'Все записи удалены.');
    }

    public function seedDatabaseTeachers()
    {
        // Запустите сидеры
        Artisan::call('db:seed --class=TeachersTableSeeder');

        return redirect()->back()->with('success', 'Сидеры запущены.');
    }
    public function seedDatabaseStudents()
    {
        // Запустите сидеры
        Artisan::call('db:seed --class=StudentsTableSeeder');

        return redirect()->back()->with('success', 'Сидеры запущены.');
    }
}