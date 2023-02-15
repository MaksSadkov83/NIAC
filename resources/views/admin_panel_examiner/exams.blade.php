@extends('.layouts.admin')

@section('href_home'){{ route('admin_panel_examiner') }}@endsection

@section('who') > Экзаменатор > {{ \Illuminate\Support\Facades\Auth::id() }}@endsection

@section('create_exam')<img src="/assets/img/desc.png" alt="" class="desc">@endsection

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
    <div class="container_table_and_student">
        <form class="form_add_student" action="{{ route('admin_panel_examiner_add_exam') }}" method="POST" id="form_add_group">
            @csrf
            <h2 style="margin-bottom: 50px;">
                <span style="color: #3c8bff;">></span> Добавить Тест:
            </h2>
            Название теста:
            <input type="text" name="exam_text" id="exam_text">

            <input type="hidden" name="examiner_id" id="examiner_id" value="{{ \Illuminate\Support\Facades\Auth::id()}}">

            <button class="add_btn" type="submit">Добавить</button>
        </form>
        <div class="container_table">
            <table id="table_for_all">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Тест</th>
                    <th>Автор</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $el)
                    <tr>
                        <td>{{ $el->id }}</td>
                        <td><a href="{{ route('admin_panel_examiner_question_topic_and_question_page', ['id' => $el->exam_id]) }}">{{ $el->text_ }}</a></td>
                        <td>{{ $el->name }}</td>
                        @if($el->editor_id == \Illuminate\Support\Facades\Auth::id())
                            <td><a href="{{ route('admin_panel_examiner_update_exam_page', ['id' => $el->exam_id]) }}"><button class="table_btn">&#8635;</button></a></td>
                            <td><a href="#"><button class="table_btn">X</button></a></td>
                        @endif
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
