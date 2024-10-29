<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use App\Models\Student; // Модель для работы с таблицей студентов

class ReportController extends Controller
{
    public function generateReport()
    {
        // Шаблон документа
        $templatePath = storage_path('app/templates/document_template.docx');
        $templateProcessor = new TemplateProcessor($templatePath);

        // Получаем всех студентов, отсортированных по фамилии и имени
        $students = Student::orderBy('last_name')
            ->orderBy('first_name')
            ->get();

        // Проверяем, есть ли студенты
        if ($students->isEmpty()) {
            return response()->json(['message' => 'Нет студентов для создания отчета'], 404);
        }

        // Клонируем строку-шаблон для каждого студента
        $templateProcessor->cloneRow('last_name', $students->count());

        // Заполняем данные студентов в таблице
        foreach ($students as $index => $student) {
            $rowNumber = $index + 1;
            $templateProcessor->setValue('last_name#' . $rowNumber, $student->last_name);
            $templateProcessor->setValue('first_name#' . $rowNumber, $student->first_name);
        }

        // Имя выходного файла
        $fileName = 'Students_' . now()->format('Y_m_d_H_i_s') . '.docx';
        $outputPath = storage_path('app/public/' . $fileName);

        // Сохраняем документ
        $templateProcessor->saveAs($outputPath);

        // Возвращаем файл для скачивания
        return response()->download($outputPath);
    }
    public function generateReport2()
    {
        // Создаем новый объект PHPWord
        $phpWord = new PhpWord();

        // Добавляем новый раздел (страницу) в документ
        $section = $phpWord->addSection();

        // Добавляем заголовок документа
        $section->addText(
            'Список студентов',
            ['name' => 'Liberation Mono', 'size' => 16, 'bold' => true]
        );

        // Получаем всех студентов, отсортированных по фамилии и имени
        $students = Student::orderBy('last_name')->orderBy('first_name')->get();

        // Если студентов нет, выводим сообщение
        if ($students->isEmpty()) {
            $section->addText('Нет данных для отображения.');
        } else {
            // Добавляем таблицу в документ
            $table = $section->addTable([
                'borderSize' => 6, 
                'borderColor' => '999999', 
                'cellMargin' => 80
            ]);

            // Добавляем заголовок таблицы
            $table->addRow();
            $table->addCell(2000)->addText('Фамилия', ['bold' => true]);
            $table->addCell(2000)->addText('Имя', ['bold' => true]);

            // Заполняем таблицу данными студентов
            foreach ($students as $student) {
                $table->addRow();
                $table->addCell(2000)->addText($student->last_name);
                $table->addCell(2000)->addText($student->first_name);
            }
        }

        // Имя выходного файла
        $fileName = 'Students2_' . now()->format('Y_m_d_H_i_s') . '.docx';
        $filePath = storage_path('app/public/' . $fileName);

        // Сохраняем документ
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($filePath);

        // Возвращаем файл для скачивания
        return response()->download($filePath);
    }
}

