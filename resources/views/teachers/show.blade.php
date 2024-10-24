@extends('layouts.app')

@section('title', 'Информация о преподавателе')

@section('content')
    <div class="container">
        <h1>Информация о преподавателе</h1>
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">{{ $teacher->first_name }} {{ $teacher->last_name }} {{ $teacher->middle_name }}</h5>
                <p class="card-text"><strong>Дата рождения:</strong> {{ $teacher->birth_date }}</p>
                <p class="card-text"><strong>Предмет:</strong> {{ $teacher->subject }}</p>
                <p class="card-text"><strong>Образование:</strong> {{ $teacher->education }}</p>
                <p class="card-text"><strong>Стаж:</strong> {{ $teacher->experience }} лет</p>
                <p class="card-text"><strong>Телефон:</strong> {{ $teacher->phone }}</p>
                <p class="card-text"><strong>Email:</strong> {{ $teacher->email }}</p>
                <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-warning">Редактировать</a>
                <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
            </div>
        </div>
    </div>
@endsection