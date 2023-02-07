@extends('layouts.admin')

@section('href_home'){{ route('admin_panel_super_user') }}@endsection

@section('who')> Super Admin @endsection

@section('side-bar')
    <div class="container_side-bar">
        <a href="{{ route('admin_panel_super_user_show_users') }}">@yield('users')Пользователи</a>
    </div>
@endsection

@section('content')
    <h2>Приветсвенное слово и инструкция</h2>
@endsection
