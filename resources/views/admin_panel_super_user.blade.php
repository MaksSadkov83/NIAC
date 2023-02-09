@extends('layouts.admin')

@section('href_home'){{ route('admin_panel_su') }}@endsection

@section('who') > Super User > {{\Illuminate\Support\Facades\Auth::id()}} @endsection

@section('side-bar')
    <div class="container_side-bar">
        <a href="{{ route('admin_panel_su_show_exam') }}">@yield('create_exam')Тесты</a>
        <a href="{{ route('admin_panel_su_show_users') }}">@yield('users')Пользователи</a>
        <a href="{{ route('admin_panel_su_link_exam') }}">@yield('link_exam')Привязать тесты</a>
        <a href="#">@yield('result_exam')Результаты тестов</a>
    </div>
@endsection

@section('content')
    <h2>Привественное слово и инструкция</h2>
@endsection
