@extends('.layouts.admin')

@section('href_home'){{ route('admin_panel_super_user') }}@endsection

@section('who')> Super Admin @endsection

@section('logout'){{ route('logout_super_admin') }}@endsection

@section('users')<span style="color: #3c8bff; margin-left: -15px; position: absolute;">></span> @endsection

@section('side-bar')
    <div class="container_side-bar">
        <a href="{{ route('admin_panel_super_user_show_users') }}">@yield('users')Пользователи</a>
    </div>
@endsection

@section('content')
    <div class="container_table_and_student">
        <form class="form_add_student" action="{{ route('add_examiners') }}" method="POST" id="form_add_group">
            @if(session('error'))
                {{ session('error') }}
            @endif
            @csrf
            <h2 style="margin-bottom: 50px;">
                <span style="color: #3c8bff;">></span> Добавить пользователя (Экзаменатор):
            </h2>
            ФИО:
            <input type="text" name="user_name" id="user_name">
            Номер телефона:
            <input type="text" name="telephon_number" id="telephon_number">
            Пароль пользователя:
            <input type="password" name="password" id="password">
            <input type="hidden" value="Экзаменатор" name="role_user" id="role_user">

            <button class="add_btn" type="submit">Добавить</button>
        </form>
        <div class="container_table">
            <table id="table_for_all">
                <thead>
                <tr>
                    <th>Идентификатор</th>
                    <th>ФИО</th>
                    <th>Номер телефона</th>
                    <th>Роль</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $el)
                    <tr>
                        <td>{{ $el->id }}</td>
                        <td>{{ $el->name }}</td>
                        <td>{{ $el->telephon_number }}</td>
                        <td>{{ $el->text_ }}</td>
                        <td><a href="{{ route('admin_panel_super_user_update_users_form', ['id' => $el->id]) }}"><button class="table_btn">&#8635;</button></a></td>
                        <td><a href="#"><button class="table_btn">X</button></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
