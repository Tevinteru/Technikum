<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class LogController extends Controller
{
    /**
     * Скачать файл с сегодняшними логами.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadTodayLogs()
    {
        $date = now()->format('Y-m-d');
        $filePath = storage_path("logs/laravel-$date.log");

        if (!File::exists($filePath)) {
            return redirect()->back()->with('error', 'Файл логов за сегодня не найден.');
        }

        return Response::download($filePath, "laravel-$date.log", [
            'Content-Type' => 'text/plain',
        ]);
    }
}