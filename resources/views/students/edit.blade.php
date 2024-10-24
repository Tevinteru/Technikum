@extends('layouts.app')

@section('title', 'Редактировать студента')

@section('content')
<div class="containter">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
    <h1>Редактировать студента</h1>

    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Имя:</label>
            <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $student->first_name) }}">
        </div>
        <div class="form-group">
            <label>Фамилия:</label>
            <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $student->last_name) }}">
        </div>
        <div class="form-group">
            <label>Группа:</label>
            <input type="text" name="group" class="form-control" value="{{ old('group', $student->group) }}">
        </div>
        <div class="form-group">
            <label>Рост:</label>
            <input type="number" name="height" class="form-control" value="{{ old('height', $student->height) }}">
        </div>
        <div class="form-group">
            <label>Дата рождения:</label>
            <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date', $student->birth_date) }}">
        </div>
        <div class="form-group">
            <label>Средний балл:</label>
            <input type="text" name="average_score" class="form-control" value="{{ old('average_score', $student->average_score) }}">
        </div>
        <div class="form-group">
            <label>Член библиотеки:</label>
            <select name="library_member" class="form-control">
                <option value="1" {{ old('library_member', $student->library_member) == '1' ? 'selected' : '' }}>Да</option>
                <option value="0" {{ old('library_member', $student->library_member) == '0' ? 'selected' : '' }}>Нет</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Сохранить</button>
    </form>
</div>

</div>
@endsection