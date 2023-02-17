@extends('.layouts.admin')

@section('href_home'){{ route('admin_panel_su') }}@endsection

@section('who') > Super Admin > {{ \Illuminate\Support\Facades\Auth::id() }}@endsection

@section('create_exam')<img src="/assets/img/desc.png" alt="" class="desc">@endsection

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
        <form class="form_add_student" action="{{ route('admin_panel_su_add_topic', ['id' => $id_exam]) }}" method="POST" id="form_add_group">
            @csrf
            <h2 style="margin-bottom: 50px;">
                <span style="color: #3c8bff;">></span> Добавить Тему:
            </h2>
            Название темы:
            <input type="text" name="topic_text" id="topic_text">
            <input type="hidden" name="exam_id" id="exam_id" value="{{ $id_exam }}">

            <button class="add_btn" type="submit">Добавить</button>
        </form>
        <div class="container_table">
            <table id="table_for_all">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Название темы</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $el)
                    <tr>
                        <td>{{ $el->id }}</td>
                        <td><a href="{{ route('admin_panel_su_question_and_option', ['id' => $el->id]) }}">{{ $el->text_ }}</a></td>
                        <td><a href="#"><button class="table_btn">&#8635;</button></a></td>
                        <td><a href="#"><button class="table_btn">X</button></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
