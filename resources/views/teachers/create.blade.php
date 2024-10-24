@extends('layouts.app')

@section('title', 'Добавить преподавателя')

@section('content')
    <div class="container">
        <h1>Добавить преподавателя</h1>
        <form action="{{ route('teachers.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="first_name">Имя</label>
                <input type="text" name="first_name" id="first_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="last_name">Фамилия</label>
                <input type="text" name="last_name" id="last_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="middle_name">Отчество</label>
                <input type="text" name="middle_name" id="middle_name" class="form-control">
            </div>
            <div class="form-group">
                <label for="birth_date">День рождения</label>
                <input type="date" name="birth_date" id="birth_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="subject">Предмет</label>
                <input type="text" name="subject" id="subject" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="education">Образование</label>
                <input type="text" name="education" id="education" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="experience">Стаж</label>
                <input type="number" name="experience" id="experience" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="phone">Телефон</label>
                <input type="text" name="phone" id="phone" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Сохранить</button>
        </form>
    </div>
@endsection