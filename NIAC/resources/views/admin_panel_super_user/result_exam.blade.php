@extends('.layouts.admin')

@section('href_home'){{ route('admin_panel_su') }}@endsection

@section('who') > Super Admin > {{ \Illuminate\Support\Facades\Auth::id() }}@endsection

@section('result_exam')<img src="/assets/img/desc.png" alt="" class="desc">@endsection

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
        <div class="container_table">
            <table id="table_for_all">
                <thead>
                <tr>
                    <th>id</th>
                    <th>ФИО студента</th>
                    <th>Тест</th>
                    <th>Результат теста</th>
                    <th>Дата сдачи</th>
                </tr>
                </thead>
                <tbody>
                @if($data == null)

                @else
                    @foreach($data as $el)
                        <tr>
                            <td>{{ $el->id }}</td>
                            <td>{{ $el->name }}</td>
                            <td>{{ $el->text_ }}</td>
                            <td>{{ $el->exam_result }}</td>
                            <td>{{ $el->exam_date }}</td>
                        </tr>
                    @endforeach
                @endif

                </tbody>
            </table>
        </div>
    </div>
@endsection
