@extends('layouts.app')

@section('title', 'Студенты')

@section('content')
<div class="container">
    <h1>Студенты</h1>
    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-2">
            {{ $message }}
        </div>
    @endif
    @if ($error = Session::get('error'))
        <div class="alert alert-danger mt-2">
            {{ $error }}
        </div>
    @endif
    <div class="container">

        <div class="d-flex flex-row">
            
            <form action="{{ route('students.create') }}" method="GET" class="w-50 m-2">
                @csrf
                <button type="submit" class="btn btn-success w-100">Добавить студента</button>
            </form>
            <form action="{{ route('truncate.table.students') }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить все записи?');" class="w-25 m-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger w-100">Удалить все записи</button>
            </form>
            <form action="{{ route('seed.database.students') }}" method="POST" class="w-25 m-2">
                @csrf
                <button type="submit" class="btn btn-primary w-100">Запустить сидеры</button>
            </form>
        </div>
        <div class="d-flex flex-row">
            <form action="{{ route('export.students') }}" method="GET" class="w-25 m-2">
                @csrf
                <button type="submit" class="btn btn-primary w-100">Эскпорт в Excel</button>
            </form>
            
            <form action="{{ route('report') }}" method="GET" class="w-25 m-2">
                @csrf
                <button type="submit" class="btn btn-primary w-100">Экспорт в Word</button>
            </form>
            <form action="{{ route('report2') }}" method="GET" class="w-25 m-2">
                @csrf
                <button type="submit" class="btn btn-primary w-100">Экспорт в Word 2</button>
            </form>
            <form action="{{ route('generate.statement') }}" method="POST" class="w-50">
                @csrf
                <div class="d-flex">
                    <select name="student_id" class="btn btn-success w-100 m-2" required>
                        <option value="">Выберите студента</option>
                        @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-success w-100 m-2">Создать документ</button>
                </div>
            </form>
        </div>
    </div>
        
        <table class="table mt-4">
            <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Группа</th>
                <th>Рост</th>
                <th>Дата рождения</th>
                <th>Средний балл</th>
                <th>Член библиотеки</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->first_name }}</td>
                    <td>{{ $student->last_name }}</td>
                    <td>{{ $student->group }}</td>
                    <td>{{ $student->height }}</td>
                    <td>{{ $student->birth_date }}</td>
                    <td>{{ $student->average_score }}</td>
                    <td>{{ $student->library_member ? 'Да' : 'Нет' }}</td>
                    <td>
                    <div>
                        <a href="{{ route('students.show', $student) }}" class="btn btn-info">Просмотр</a>
                        <a href="{{ route('students.edit', $student) }}" class="btn btn-warning">Редактировать</a>
                        <form action="{{ route('students.destroy', $student) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection