@extends('layouts.admin')

@section('create_exam')<span style="color: #3c8bff; margin-left: -15px; position: absolute;">></span>@endsection

@section('side-bar')
    <div class="container_side-bar">
        <a href="{{route('create_exam_page')}}">@yield('create_exam')Создать тест</a>
        <a href="{{route('show_exam')}}">@yield('show_exam')Посмотреть тесты</a>
        <a href="{{route('users')}}">@yield('users')Пользователи</a>
        <a href="#"></a>
    </div>
@endsection

@section('content')
    <div class="container_form_and_table">
        <form class="form_add_student" action="{{ route('create_exam') }}" method="POST" id="form_add_group">
            @csrf
            <h2 style="margin-bottom: 50px;">
                <span style="color: #3c8bff;">></span> Создать Тест:
            </h2>
            <input type="hidden" name="editor_id" id="editor_id" value="{{ $user_id }}">
            Название теста:
            <input type="text" name="exam_text" id="exam_text">
            <button class="add_btn" type="submit">Добавить</button>
        </form>
    </div>
@endsection
