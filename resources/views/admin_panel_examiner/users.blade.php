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
    <div class="container_table_and_student">
        <form class="form_add_student" action="{{ route('admin_panel_examiner_add_users') }}" method="POST" id="form_add_group">
            @csrf
            <h2 style="margin-bottom: 50px;">
                <span style="color: #3c8bff;">></span> Добавить пользователя (Экзаменующийся):
            </h2>
            ФИО:
            <input type="text" name="user_name" id="user_name">
            Номер телефона:
            <input type="text" name="telephone_number" id="telephone_number">
            Пароль пользователя:
            <input type="password" name="password" id="password">

            <input type="hidden" name="role_user_choose" id="role_user_choose" value="Экзаменующийся">

            Автивен/Неактивен:
            <input type="hidden" id="active_user" name="active_user" value="0">
            <input type="checkbox" id="active_user" name="active_user" value="1">
            <button class="add_btn" type="submit">Добавить</button>
        </form>
        <div class="container_table">
            <table id="table_for_all">
                <thead>
                <tr>
                    <th>Индитификатор</th>
                    <th>ФИО</th>
                    <th>Роль</th>
                    <th>Номер телефона</th>
                    <th>Активность</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $el)
                    <tr>
                        <td>{{ $el->id }}</td>
                        <td>{{ $el->name }}</td>
                        <td>{{ $el->text_ }}</td>
                        <td>{{ $el->telephon_number }}</td>
                        <td>{{ $el->active }}</td>
                        <td><a href="{{ route('admin_panel_examiner_show_update_users', ['id' => $el->id]) }}"><button class="table_btn">&#8635;</button></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if(session('error'))
        <div class="notification">
            <div class="field_message">
                {{ session('error') }}
            </div>
            <div class="delete_notification">
                +
            </div>
        </div>
    @endif

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
