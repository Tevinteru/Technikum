<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'group' => 'required|string|max:255',
            'height' => 'required|integer',
            'birth_date' => 'required|date',
            'average_score' => 'required|numeric|min:0|max:5',
            'library_member' => 'required|boolean',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')
                         ->with('success', 'Студент добавлен успешно.');
    }

    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'group' => 'required|string|max:255',
            'height' => 'required|integer',
            'birth_date' => 'required|date',
            'average_score' => 'required|numeric|min:0|max:5',
            'library_member' => 'required|boolean',
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')
                         ->with('success', 'Данные студента обновлены.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
                         ->with('success', 'Студент удалён.');
    }
    public function exportStudents(Request $request)
    {
        $students = Student::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Имя');
        $sheet->setCellValue('B1', 'Фамилия');
        $sheet->setCellValue('C1', 'Группа');
        $sheet->setCellValue('D1', 'Рост');
        $sheet->setCellValue('E1', 'Дата Рождения');
        $sheet->setCellValue('F1', 'Ср. Балл');
        $sheet->setCellValue('G1', 'Член Библиотеки');

        $row = 2;
        foreach ($students as $student) {
            $sheet->setCellValue('A' . $row, $student->first_name);
            $sheet->setCellValue('B' . $row, $student->last_name);
            $sheet->setCellValue('C' . $row, $student->group);
            $sheet->setCellValue('D' . $row, $student->height);
            $sheet->setCellValue('E' . $row, $student->birth_date);
            $sheet->setCellValue('F' . $row, $student->average_score);
            $sheet->setCellValue('G' . $row, $student->library_member);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);

        // Сохраняем файл во временное место
        $fileName = 'students_' . time() . '.xlsx';
        $filePath = storage_path('app/public/' . $fileName);
        $writer->save($filePath);
    
        return response()->download($filePath);
    }
}