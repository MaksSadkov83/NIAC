@extends('layouts.admin')

@section('create_exam')@endsection

@section('side-bar')
    <div class="container_side-bar">
        <a href="{{route('create_exam_page')}}">@yield('create_exam')Создать тест</a>
        <a href="{{route('show_exam')}}">@yield('show_exam')Посмотреть тесты</a>
        <a href="{{route('users')}}">@yield('users')Пользователи</a>
        <a href="#"></a>
    </div>
@endsection

@section('content')
    <h2>Тут должно быть привественное предложение!!!!!!!!!</h2>
@endsection
