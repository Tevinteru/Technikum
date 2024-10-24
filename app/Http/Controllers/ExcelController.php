<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class ExcelController extends Controller
{
    public function showForm()
    {
        return view('excel_form');
    }

    public function handleForm(Request $request)
    {
        // Валидация данных формы
        $validated = $request->validate([
            'поле1' => 'required|string',
            'поле2' => 'required|string',
            'поле3' => 'required|string',
            'поле4' => 'required|string',
            'поле5' => 'required|string',
        ]);

        // Путь к файлу Excel
        $filePath = storage_path('app/excel/data.xlsx');

        // Загрузка или создание новой таблицы
        if (file_exists($filePath)) {
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
            $sheet = $spreadsheet->getActiveSheet();
        } else {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            // Заголовки
            $sheet->fromArray(['Поле1', 'Поле2', 'Поле3', 'Поле4', 'Поле5', 'Min'], null, 'A1');
        }

        // Найти следующую пустую строку
        $row = $sheet->getHighestRow() + 1;

        // Запись данных в ячейки
        $sheet->fromArray([
            $validated['поле1'],
            $validated['поле2'],
            $validated['поле3'],
            $validated['поле4'],
            $validated['поле5']
        ], null, 'A' . $row);

        // Запись формулы для нахождения минимального значения
        $sheet->setCellValue('F' . $row, '=MIN(A' . $row . ':E' . $row . ')');

        // Сохранение файла
        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);

        return back()->with('success', 'Данные успешно добавлены в Excel файл.');
    }
    public function downloadExcel()
    {
        $filePath = storage_path('app/excel/data.xlsx');

        if (!file_exists($filePath)) {
            return back()->with('error', 'Файл не найден.');
        }

        return response()->download($filePath, 'data.xlsx');
    }
}
