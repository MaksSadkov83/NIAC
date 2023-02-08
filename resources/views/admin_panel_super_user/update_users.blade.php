@extends('.layouts.admin')

@section('href_home'){{ route('admin_panel_super_user') }}@endsection

@section('who') Super Admin @endsection

@section('users')<span style="color: #3c8bff; margin-left: -15px; position: absolute;">></span>@endsection

@section('side-bar')
    <div class="container_side-bar">
        <a href="{{ route('admin_panel_super_user_show_users') }}">@yield('users')Пользователи</a>
    </div>
@endsection

@section('content')
    <form class="form_add_student" action="{{ route('admin_panel_super_user_update_user', ['id' => $id]) }}" method="POST" id="form_add_group">
        @csrf
        <h2 style="margin-bottom: 50px;">
            <span style="color: #3c8bff;">></span> Обновить пользователя (Экзаменатор):
        </h2>
        ФИО (Если не хотите менять пропустите поле):
        <input type="text" name="user_name" id="user_name" value="{{ $data->name }}">
        Номер телефона (Если не хотите менять пропустите поле):
        <input type="text" name="telephon_number" id="telephon_number" value="{{ $data->telephon_number }}">
        Пароль пользователя (Если не хотите менять оставьте пустым):
        <input type="password" name="password" id="password">
        <input type="hidden" value="Экзаменатор" name="role_user" id="role_user">

        <button class="add_btn" type="submit">Обновить</button>
    </form>
@endsection
