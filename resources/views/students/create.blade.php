@extends('layouts.app')

@section('title', 'Добавить студента')

@section('content')
<div class="containter">
    <h1>Добавить студента</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Имя:</label>
            <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}">
        </div>
        <div class="form-group">
            <label>Фамилия:</label>
            <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}">
        </div>
        <div class="form-group">
            <label>Группа:</label>
            <input type="text" name="group" class="form-control" value="{{ old('group') }}">
        </div>
        <div class="form-group">
            <label>Рост:</label>
            <input type="number" name="height" class="form-control" value="{{ old('height') }}">
        </div>
        <div class="form-group">
            <label>Дата рождения:</label>
            <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date') }}">
        </div>
        <div class="form-group">
            <label>Средний балл:</label>
            <input type="text" name="average_score" class="form-control" value="{{ old('average_score') }}">
        </div>
        <div class="form-group">
            <label>Член библиотеки:</label>
            <select name="library_member" class="form-control">
                <option value="1" {{ old('library_member') == '1' ? 'selected' : '' }}>Да</option>
                <option value="0" {{ old('library_member') == '0' ? 'selected' : '' }}>Нет</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Добавить</button>
    </form>
</div>
@endsection