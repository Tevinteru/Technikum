@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <div class="container">
        <div class="text-center">
            <h1>Ангарский политехнический техникум</h1>
            <img src="{{ asset('images/main.png') }}" alt="Техникум" class="img-fluid w-25 h-25 mt-4">
        </div>

        <p class="lead mt-4">Добро пожаловать на сайт Ангарского политехнического техникума!</p>
    </div>
@endsection