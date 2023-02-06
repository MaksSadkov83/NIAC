@extends('layouts.admin')

@section('users')<span style="color: #3c8bff; margin-left: -15px; position: absolute;">></span>@endsection

@section('side-bar')
    <div class="container_side-bar">
        <a href="{{route('create_exam_page')}}">@yield('create_exam')Создать тест</a>
        <a href="{{route('show_exam')}}">@yield('show_exam')Посмотреть тесты</a>
        <a href="{{route('users')}}">@yield('users')Пользователи</a>
        <a href="#"></a>
    </div>
@endsection

@section('content')
    <div class="container_table_and_student">
        <form class="form_add_student" action="{{ route('update_users') }}" method="POST" id="form_add_group">
            @csrf
            <h2 style="margin-bottom: 50px;">
                <span style="color: #3c8bff;">></span> Обновить пользователя <span style="color: #3c8bff;">></span> {{ $data->id }}:
            </h2>
            <input type="hidden" name="id" id="id" value="{{ $data->id }}">
            Пароль пользователя (Оставьте пустым если не хотите менять):
            <input type="text" name="password" id="password">
            Роль пользователя (Не стирайте, если не хотите менять):
            <input list="role_user" name="role_user" id="role_user" value="{{ $data->text_ }}">
            <datalist id="role_user">
                <option value="Экзаменатор"></option>
                <option value="Экзаменующийся"></option>
            </datalist>
            <button class="add_btn" type="submit">Обновить</button>
        </form>
    </div>
@endsection
