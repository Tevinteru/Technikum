<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

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
        try{
            Artisan::call('db:seed --class=TeachersTableSeeder');
            return redirect()->back()->with('success', 'Сидеры запущены.');
        } catch (Exception $e){
            return redirect()->back()->with('error', 'Ошибка.');

            Log::error('Ошибка при заполнении таблицы студентов: ' . $e->getMessage());
        }
        // Запустите сидеры

    }
    public function seedDatabaseStudents()
    {
        try {
            // Запустите сидеры
            Artisan::call('db:seed', ['--class' => 'StudentsTableSeeder']);
            
            // Логируем успешное выполнение
            Log::channel('pail')->info('Сидеры для таблицы студентов успешно запущены.');
            
            return redirect()->back()->with('success', 'Сидеры запущены.');
        } catch (Exception $e) {
            // Логируем ошибку
            Log::channel('pail')->error('Ошибка при запуске сидеров для таблицы студентов: ' . $e->getMessage());
            
            // Перенаправляем обратно с сообщением об ошибке
            return redirect()->back()->with('error', 'Произошла ошибка при запуске сидеров.');
        }
    }
}