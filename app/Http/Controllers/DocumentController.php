<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class DocumentController extends Controller
{
    public function generateStatement(Request $request)
    {

        $request->validate([
            'student_id' => 'required|exists:students,id',
        ]);

        $student = Student::findOrFail($request->student_id);
        // Путь к шаблону документа
        $templatePath = storage_path('app/templates/statement_template.docx');
        
        // Создаем объект TemplateProcessor
        $templateProcessor = new TemplateProcessor($templatePath);
        
        // Random car models
        $carModels = ['Toyota Corolla', 'Honda Civic', 'Ford Focus', 'Chevrolet Malibu', 'Nissan Altima'];
        $randomCarModel = $carModels[array_rand($carModels)];
        
        // Random start and end dates
        $startDate = now()->addDays(rand(0, 30))->format('d.m.Y');
        $endDate = now()->addDays(rand(31, 60))->format('d.m.Y');
        
        // Заполняем шаблон данными студента
        $templateProcessor->setValue('first_name', $student->first_name);
        $templateProcessor->setValue('last_name', $student->last_name);
        $templateProcessor->setValue('car_model', $randomCarModel);
        $templateProcessor->setValue('start_date', $startDate);
        $templateProcessor->setValue('end_date', $endDate);
        $templateProcessor->setValue('document_date', now()->format('d.m.Y'));
        $templateProcessor->setValue('signature', $student->last_name);
        
        // Создаем имя для нового документа
        $fileName = 'statement_' . $student->id . "_" . now()->format('Y_m_d_H_i_s') . '.docx';
        $filePath = storage_path('app/public/' . $fileName);
        
        // Сохраняем заполненный шаблон как новый документ
        $templateProcessor->saveAs($filePath);
        
        // Возвращаем ссылку на скачивание документа
        return response()->download($filePath);
    }
}