@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Контакты</h1>
    <p>Свяжитесь с нами по следующим контактам:</p>
    <ul>
        <li>Телефон: +7 (123) 456-78-90</li>
        <li>Email: info@apt.ru</li>
        <li>Адрес: г. Ангарск, ул. Политехническая, д. 1</li>
    </ul>
    <div class="row">
        <div class="col-md-4">
            <img src="{{ asset('images/contacts1.jpg') }}" alt="Фото 1" class="img-fluid">
        </div>
        <div class="col-md-4">
            <img src="{{ asset('images/contacts2.jpg') }}" alt="Фото 2" class="img-fluid">
        </div>
        <div class="col-md-4">
            <img src="{{ asset('images/contacts3.jpg') }}" alt="Фото 3" class="img-fluid">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-4">
            <img src="{{ asset('images/contacts4.jpg') }}" alt="Фото 4" class="img-fluid">
        </div>
        <div class="col-md-4">
            <img src="{{ asset('images/contacts5.jpg') }}" alt="Фото 5" class="img-fluid">
        </div>
        <div class="col-md-4">
            <img src="{{ asset('images/contacts6.jpg') }}" alt="Фото 6" class="img-fluid">
        </div>
    </div>
</div>
@endsection