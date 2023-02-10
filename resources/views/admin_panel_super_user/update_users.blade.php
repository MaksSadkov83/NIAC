@extends('.layouts.admin')

@section('href_home'){{ route('admin_panel_su') }}@endsection

@section('who') > Super Admin > {{ \Illuminate\Support\Facades\Auth::id() }}@endsection

@section('users')<span style="color: #3c8bff; margin-left: -15px; position: absolute;">></span>@endsection

@section('side-bar')
    <div class="container_side-bar">
        <a href="{{ route('admin_panel_su_show_exam') }}">@yield('create_exam')Тесты</a>
        <a href="{{ route('admin_panel_su_show_users') }}">@yield('users')Пользователи</a>
        <a href="{{ route('admin_panel_su_link_exam') }}">@yield('link_exam')Привязать тесты</a>
        <a href="{{ route('admin_panel_us_show_result_exam') }}">@yield('result_exam')Результаты тестов</a>
    </div>
@endsection

@section('content')
    <div class="container_table_and_student">
        <form class="form_add_student" action="{{ route('update_users', ['id' => $data->id]) }}" method="POST" id="form_add_group">
            @csrf
            <h2 style="margin-bottom: 50px;">
                <span style="color: #3c8bff;">></span> Обновить пользователя <span style="color: #3c8bff;">></span> {{ $data->name }}:
            </h2>
            ФИО (если не хотите менять пропустите поле):
            <input type="text" name="user_name" id="user_name" value="{{ $data->name }}">
            Номер телефона (если не хотите менять пропустите поле):
            <input type="text" name="telephone_number" id="telephone_number" value="{{ $data->telephon_number }}">
            Пароль пользователя (если не хотите менять оставьте поле пустым):
            <input type="password" name="password" id="password">
            Роль пользователя (если не хотите менять пропустите поле, иначе просто сотрите):
            <input list="role_user" name="role_user_choose" id="role_user_choose" value="{{ $data->text_ }}">
            <datalist id="role_user">
                <option value="SuperAdmin"></option>
                <option value="Экзаменатор"></option>
                <option value="Экзаменующийся"></option>
            </datalist>
            Автивен/Неактивен (если не хотите менять пропустите поле):
            <input type="hidden" id="active_user" name="active_user" value="0">
            @if($data->active == 1)
                <input type="checkbox" id="active_user" name="active_user" value="1" checked>
            @else
                <input type="checkbox" id="active_user" name="active_user" value="1">
            @endif
            <button class="add_btn" type="submit">Добавить</button>
        </form>
    </div>
@endsection
