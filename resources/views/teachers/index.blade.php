@extends('layouts.app')

@section('title', 'Преподаватели')

@section('content')
    <div class="container">
        <h1>Преподаватели</h1>
        @if ($message = Session::get('success'))
        <div class="alert alert-success mt-2">
            {{ $message }}
        </div>
        @endif
        <div class="container d-flex">
            <a href="{{ route('teachers.create') }}" class="btn btn-primary w-25 m-2 text-center">Добавить преподавателя</a>

            <form action="{{ route('truncate.table.teachers') }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить все записи?');" class="w-25 m-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger w-100">Удалить все записи</button>
            </form>

            <form action="{{ route('seed.database.teachers') }}" method="POST" class="w-25 m-2">
                @csrf
                <button type="submit" class="btn btn-primary w-100">Запустить сидеры</button>
            </form>

            <a href="{{ route('export.teachers') }}" class="btn btn-primary w-25 m-2 text-center">Эскпорт в Excel</a>

        </div>
       
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Фамилия</th>
                    <th>Имя</th>
                    <th>Отчество</th>
                    <th>Предмет</th>
                    <th>Телефон</th>
                    <th>E-mail</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->id }}</td>
                        <td>{{ $teacher->last_name }}</td>
                        <td>{{ $teacher->first_name }}</td>
                        <td>{{ $teacher->middle_name }}</td>
                        <td>{{ $teacher->subject }}</td>
                        <td>{{ $teacher->phone }}</td>
                        <td>{{ $teacher->email }}</td>
                        <td>
                        <div>
                            <a href="{{ route('teachers.show', $teacher) }}" class="btn btn-info">Просмотр</a>
                                <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-warning">Редактировать</a>
                            <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" style="display:inline;">
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