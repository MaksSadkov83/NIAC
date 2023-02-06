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
        <form class="form_add_student" action="{{ route('update_exam') }}" method="POST" id="form_add_group">
            @csrf
            <h2 style="margin-bottom: 50px;">
                <span style="color: #3c8bff;">></span> Обновить Тест <span style="color: #3c8bff;">></span> {{ $data->text_ }}:
            </h2>
            <input type="hidden" name="exam_id" id="exam_id" value="{{ $data->id }}">
            Название теста:
            <input type="text" name="exam_text" id="exam_text" value="{{ $data->text_ }}">
            <button class="add_btn" type="submit">Обновить</button>
        </form>

    </div>
@endsection
