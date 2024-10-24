<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::all();
        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('teachers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'birth_date' => 'required|date',
            'subject' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'experience' => 'required|integer',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:teachers,email',
        ]);

        Teacher::create($request->all());

        return redirect()->route('teachers.index')
                         ->with('success', 'Преподаватель добавлен успешно.');
    }

    public function show(Teacher $teacher)
    {
        return view('teachers.show', compact('teacher'));
    }

    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'birth_date' => 'required|date',
            'subject' => 'required|string|max:255',
            'education' => 'required|string|max:255',
            'experience' => 'required|integer',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
        ]);

        $teacher->update($request->all());

        return redirect()->route('teachers.index')
                         ->with('success', 'Данные преподавателя обновлены.');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return redirect()->route('teachers.index')
                         ->with('success', 'Преподаватель удалён.');
    }
    public function exportTeachers(Request $request)
    {
        $teachers = Teacher::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Фамилия');
        $sheet->setCellValue('B1', 'Имя');
        $sheet->setCellValue('C1', 'Отчество');
        $sheet->setCellValue('D1', 'Предмет');
        $sheet->setCellValue('E1', 'Телефон');
        $sheet->setCellValue('F1', 'E-mail');

        $row = 2;
        foreach ($teachers as $teacher) {
            $sheet->setCellValue('A' . $row, $teacher->last_name);
            $sheet->setCellValue('B' . $row, $teacher->first_name);
            $sheet->setCellValue('C' . $row, $teacher->middle_name);
            $sheet->setCellValue('D' . $row, $teacher->subject);
            $sheet->setCellValue('E' . $row, $teacher->phone);
            $sheet->setCellValue('F' . $row, $teacher->email);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);

        // Сохраняем файл во временное место
        $fileName = 'teachers_' . time() . '.xlsx';
        $filePath = storage_path('app/public/' . $fileName);
        $writer->save($filePath);
    
        return response()->download($filePath);
    }
    
}
