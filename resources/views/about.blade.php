@extends('layouts.app')

@section('content')
<div class="container">
    <h1>О техникуме</h1>
    <p>Техникум предлагает современные образовательные программы и курсы.</p>
    <div class="row">
        <div class="col-md-4">
            <img src="{{ asset('images/about1.jpg') }}" alt="Фото 1" class="img-fluid">
        </div>
        <div class="col-md-4">
            <img src="{{ asset('images/about2.jpg') }}" alt="Фото 2" class="img-fluid">
        </div>
        <div class="col-md-4">
            <img src="{{ asset('images/about3.jpg') }}" alt="Фото 3" class="img-fluid">
        </div>
    </div>
 
</div>
@endsection