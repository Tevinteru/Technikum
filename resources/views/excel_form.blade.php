@extends('layouts.app')

@section('content')
<div class="container">
@if (session('success'))
        <p>{{ session('success') }}</p>
    @endif
    @if (session('error'))
        <p>{{ session('error') }}</p>
    @endif
    <form action="/excel-form" method="POST">
        @csrf
        <div class="form-group">
            <label for="поле1">Поле 1:</label>
            <input class="form-control" type="text" name="поле1" required><br>
        </div>
        <div class="form-group">
            <label for="поле2">Поле 2:</label>
            <input class="form-control" type="text" name="поле2" required><br>
        </div>
        <div class="form-group">
            <label for="поле3">Поле 3:</label>
            <input class="form-control" type="text" name="поле3" required><br>
        </div>
        <div class="form-group">
            <label for="поле4">Поле 4:</label>
            <input class="form-control" type="text" name="поле4" required><br>
        </div>
        <div class="form-group">
            <label for="поле5">Поле 5:</label>
            <input class="form-control" type="text" name="поле5" required><br>
        </div>
        <br>
            <button class="btn btn-primary" type="submit">Отправить</button>
            <a class="btn btn-primary mx-2" href="/download-excel">Скачать Excel</a>
        </form>
    </div>
</div>
@endsection

