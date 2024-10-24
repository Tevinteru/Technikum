@extends('layouts.app')

@section('title', 'Просмотр студента')

@section('content')
<div class="container">
    <h1>Просмотр студента</h1>
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">{{ $student->first_name }} {{ $student->last_name }}</h5>
            <p class="card-text"><strong>Группа:</strong> {{ $student->group }}</p>
            <p class="card-text"><strong>Рост:</strong> {{ $student->height }} см</p>
            <p class="card-text"><strong>Дата рождения:</strong> {{ $student->birth_date }}</p>
            <p class="card-text"><strong>Средний балл:</strong> {{ $student->average_score }}</p>
            <p class="card-text"><strong>Член библиотеки:</strong> {{ $student->library_member ? 'Да' : 'Нет' }}</p>
            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning">Редактировать</a>
            <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Удалить</button>
            </form>
            <a href="{{ route('students.index') }}" class="btn btn-secondary mt-2">Назад к списку</a>
        </div>
    </div>
</div>
@endsection