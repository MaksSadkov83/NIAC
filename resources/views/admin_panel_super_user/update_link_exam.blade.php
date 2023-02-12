@extends('.layouts.admin')

@section('href_home'){{ route('admin_panel_su') }}@endsection

@section('who') > Super Admin > {{ \Illuminate\Support\Facades\Auth::id() }}@endsection

@section('link_exam')<img src="/assets/img/desc.png" alt="" class="desc">@endsection

@section('side-bar')
    <div class="container_side-bar">
        <img src="/assets/img/nao_logo2 — копия (2).png" alt="" class="logo_nao">
        <a href="{{ route('admin_panel_su_show_exam') }}">@yield('create_exam')Тесты</a>
        <a href="{{ route('admin_panel_su_show_users') }}">@yield('users')Пользователи</a>
        <a href="{{ route('admin_panel_su_link_exam') }}">@yield('link_exam')Привязать тесты</a>
        <a href="{{ route('admin_panel_us_show_result_exam') }}">@yield('result_exam')Результаты тестов</a>
    </div>
@endsection

@section('content')
    <div class="container_table_and_student">
        <form class="form_add_student" action="{{ route('admin_panel_su_update_link_exam', ['id' => $student_answers->id]) }}" method="POST" id="form_add_group">
            @csrf
            <h2 style="margin-bottom: 50px;">
                <span style="color: #3c8bff;">></span> Обновить привязку студента "{{ $current_users->name }}" к тесту "{{ $current_exam->text_ }}":
            </h2>
            Название теста:
            <input type="text" list="exam_list" name="exam_choose" id="exam_choose" value="{{ $student_answers->exam_id }}">
            <datalist id="exam_list">
                @foreach($exam_list as $el)
                    <option value="{{ $el->id }}">{{ $el->text_ }}</option>
                @endforeach
            </datalist>
            Студент:
            <input list="student_list" name="student" id="student" value="{{ $student_answers->student_id }}">
            <datalist id="student_list">
                @foreach($students as $el)
                    <option value="{{ $el->id }}">{{ $el->name }}</option>
                @endforeach
            </datalist>
            Минимальный балл за тест:
            <input type="number" name="min_score" id="min_score" value="{{ $student_answers->min_score }}">
            <button class="add_btn" type="submit">Привязать</button>
        </form>
    </div>
@endsection
