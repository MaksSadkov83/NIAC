@extends('.layouts.admin')

@section('href_home'){{ route('admin_panel_su') }}@endsection

@section('who') > Super Admin > {{ \Illuminate\Support\Facades\Auth::id() }} @endsection

@section('create_exam')<img src="./assets/img/desc.png" alt="" class="desc">@endsection

@section('side-bar')
    <div class="container_side-bar">
        <img src="./assets/img/nao_logo2 — копия (2).png" alt="" class="logo_nao">
        <a href="{{ route('admin_panel_su_show_exam') }}">@yield('create_exam')Тесты</a>
        <a href="{{ route('admin_panel_su_show_users') }}">@yield('users')Пользователи</a>
        <a href="{{ route('admin_panel_su_link_exam') }}">@yield('link_exam')Привязать тесты</a>
        <a href="{{ route('admin_panel_us_show_result_exam') }}">@yield('result_exam')Результаты тестов</a>
    </div>
@endsection

@section('content')
    <div class="container_for_card">
        <h2 id="{{ $id }}" class="h2">Тема: {{ $name_topic }}</h2>
        <br>
        <div class="card_topic">
            <div class="container_card_topic">
                <button class="add_card_question" onclick="Add_card_question(event)">
                    <div class="container_card_btn">
                        + Создать вопорос
                    </div>
                </button>
            </div>
        </div>
        <button class="create_card_topic" onclick="Send()">
            Сохранить
        </button>
    </div>

@endsection
