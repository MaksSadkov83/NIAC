@extends('.layouts.admin')

@section('href_home'){{ route('admin_panel_examiner') }}@endsection

@section('who') > Экзаменатор > {{ \Illuminate\Support\Facades\Auth::id() }}@endsection

@section('users')<img src="/assets/img/desc.png" alt="" class="desc">@endsection

@section('side-bar')
    <div class="container_side-bar">
        <img src="/assets/img/nao_logo2 — копия (2).png" alt="" class="logo_nao">
        <a href="{{ route('admin_panel_examiner_show_exam') }}">@yield('create_exam')Тесты</a>
        <a href="{{ route('admin_panel_examiner_users_show') }}">@yield('users')Пользователи</a>
        <a href="{{ route('admin_panel_examiner_link_exam_page') }}">@yield('link_exam')Привязать тесты</a>
        <a href="{{ route('admin_panel_examiner_show_result_exam') }}">@yield('result_exam')Результаты тестов</a>
    </div>
@endsection

@section('content')
    <div class="contauiner_table_and_student">
        <form class="form_add_student" action="#" method="POST" id="form_add_group">
            @csrf
            <h2 style="margin-bottom: 50px;">
                <span style="color: #3c8bff;">></span> Обновить Тест "{{ $exam->text_ }}":
            </h2>
            Название теста:
            <input type="text" name="exam_text" id="exam_text" value="{{ $exam->text_ }}">

            <input type="hidden" name="exam_id" id="examr_id" value="{{ $exam->id }}">

            <button class="add_btn" type="submit">Обновить</button>
        </form>
    </div>

    @if(session('success'))
        <div class="notification">
            <div class="field_message">
                {{ session('success') }}
            </div>
            <div class="delete_notification">
                +
            </div>
        </div>
    @endif
@endsection
