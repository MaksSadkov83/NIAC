@extends('layouts.admin')

@section('users')<span style="color: #3c8bff; margin-left: -15px; position: absolute;">></span>@endsection

@section('side-bar')
    <div class="container_side-bar">
        <a href="{{route('create_exam_page')}}">@yield('create_exam')Создать тест</a>
        <a href="{{route('show_exam')}}">@yield('show_exam')Посмотреть тесты</a>
        <a href="{{route('users')}}">@yield('users')Пользователи</a>
        <a href="#"></a>
    </div>
@endsection

@section('content')
    <div class="container_table_and_student">
        <form class="form_add_student" action="{{route('registration_user_form')}}" method="POST" id="form_add_group">
            @csrf
            <h2 style="margin-bottom: 50px;">
                <span style="color: #3c8bff;">></span> Добавить пользователя:
            </h2>
            Идентифиционный номер:
            <input type="text" name="id" id="id">
            Пароль пользователя:
            <input type="password" name="password" id="password">
            Роль пользователя:
            <input list="role_user" name="role_user" id="role_user">
            <datalist id="role_user">
                <option value="Экзаменатор"></option>
                <option value="Экзаменующийся"></option>
            </datalist>
            <button class="add_btn" type="submit">Добавить</button>
        </form>
        <div class="container_table">
            <table id="table_for_all">
                <thead>
                <tr>
                    <th>Идентификатор</th>
                    <th>Роль</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $el)
                    <tr>
                        <td>{{ $el->id }}</td>
                        <td>{{ $el->text_ }}</td>
                        <td><a href="{{ route('update_users_page', ['id' => $el->id]) }}"><button class="table_btn">&#8635;</button></a></td>
                        <td><a href="{{ route('delete_user', ['id' => $el->id]) }}"><button class="table_btn">X</button></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
