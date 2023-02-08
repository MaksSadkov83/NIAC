@extends('layouts.admin')

@section('href_home'){{ route('admin_panel_examiner') }}@endsection

@section('who') > {{ \Illuminate\Support\Facades\Auth::id() }}@endsection

@section('side-bar')
    <div class="container_side-bar">
        <a href="#">@yield('create_exam')Создать тест</a>
        <a href="#">@yield('exam')Посмотреть тесты</a>
        <a href="{{ route('admin_panel_examiner_show_users') }}">@yield('users')Пользователи</a>
    </div>
@endsection

@section('content')
    <h2>Приветсвенное слово и инструкция</h2>
@endsection
