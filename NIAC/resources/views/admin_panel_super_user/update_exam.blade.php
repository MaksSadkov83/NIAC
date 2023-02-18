@extends('.layouts.admin')

@section('href_home'){{ route('admin_panel_su') }}@endsection

@section('who') > Super Admin > {{ \Illuminate\Support\Facades\Auth::id() }}@endsection

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
    <div class="contauiner_table_and_student">
        <form class="form_add_student" action="{{ route('admin_panel_su_update_exam', ['id' => $editor_exam->id]) }}" method="POST" id="form_add_group">
            @csrf
            <h2 style="margin-bottom: 50px;">
                <span style="color: #3c8bff;">></span> Обновить Тест "{{ $editor_exam->text_ }}":
            </h2>
            Название теста:
            <input type="text" name="exam_text" id="exam_text" value="{{ $editor_exam->text_ }}">
            Экзаменатор:
            <input list="examiner_list" name="examiner_id" id="examiner_id" value="{{ $editor_exam->editor_id }}">
            <datalist id="examiner_list">
                @foreach($examiners as $el)
                    <option value="{{ $el->id }}">{{ $el->name }}</option>
                @endforeach
            </datalist>
            <input type="hidden" name="exam_id" id="exam_id" value="{{ $editor_exam->exam_id }}">
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
