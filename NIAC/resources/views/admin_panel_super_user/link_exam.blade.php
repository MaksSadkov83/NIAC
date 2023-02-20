@extends('.layouts.admin')

@section('href_home'){{ route('admin_panel_su') }}@endsection

@section('who') > Super Admin > {{ \Illuminate\Support\Facades\Auth::id() }}@endsection

@section('link_exam')<img src="/public/assets/img/desc.png" alt="" class="desc">@endsection

@section('side-bar')
    <div class="container_side-bar">
        <img src="/public/assets/img/nao_logo2 — копия (2).png" alt="" class="logo_nao">
        <a href="{{ route('admin_panel_su_show_exam') }}">@yield('create_exam')Тесты</a>
        <a href="{{ route('admin_panel_su_show_users') }}">@yield('users')Пользователи</a>
        <a href="{{ route('admin_panel_su_link_exam') }}">@yield('link_exam')Привязать тесты</a>
        <a href="{{ route('admin_panel_us_show_result_exam') }}">@yield('result_exam')Результаты тестов</a>
    </div>
@endsection

@section('content')
    <div class="container_table_and_student">
        <form class="form_add_student" action="{{ route('admin_panel_su_link_exam') }}" method="POST" id="form_add_group">
            @csrf
            <h2 style="margin-bottom: 50px;">
                <span style="color: #3c8bff;">></span> Привязать Тест:
            </h2>
            Название теста:
            <input type="text" list="exam_list" name="exam_choose" id="exam_choose">
                <datalist id="exam_list">
                    @foreach($exam_list as $el)
                        <option value="{{ $el->id }}">{{ $el->text_ }}</option>
                    @endforeach
                </datalist>
            Студент:
            <input list="student_list" name="student" id="student">
                <datalist id="student_list">
                    @foreach($students as $el)
                        <option value="{{ $el->id }}">{{ $el->name }}</option>
                    @endforeach
                </datalist>
            Минимальный балл за тест:
            <input type="number" name="min_score" id="min_score">
            <button class="add_btn" type="submit">Привязать</button>
        </form>
        <div class="container_table">
            <table id="table_for_all">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Тест</th>
                    <th>Студент</th>
                    <th>Минимальный балл</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $el)
                    <tr>
                        <td>{{ $el->id }}</td>
                        <td>{{ $el->text_ }}</td>
                        <td>{{ $el->name }}</td>
                        <td>{{ $el->min_score }}</td>
                        <td><a href="{{ route('admin_panel_su_update_link_exam_page', ['id' => $el->id]) }}"><button class="table_btn">&#8635;</button></a></td>
                        <td><a href="{{ route('admin_panel_su_delete_link_exam', ['id' => $el->id]) }}"><button class="table_btn">X</button></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
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
