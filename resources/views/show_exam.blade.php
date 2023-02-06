@extends('layouts.admin')

@section('show_exam')<span style="color: #3c8bff; margin-left: -15px; position: absolute;">></span>@endsection

@section('side-bar')
    <div class="container_side-bar">
        <a href="{{route('create_exam_page')}}">@yield('create_exam')Создать тест</a>
        <a href="{{route('show_exam')}}">@yield('show_exam')Посмотреть тесты</a>
        <a href="{{route('users')}}">@yield('users')Пользователи</a>
        <a href="#"></a>
    </div>
@endsection

@section('content')
        <div class="container_table">
            <table id="table_for_all">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Название теста</th>
                    <th>Автор</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($data as $el)
                        <tr>
                            <td>{{ $el->id }}</td>
                            <td><a href="#">{{ $el->text_ }}</a></td>
                            <td>{{ $el->editor_id }}</td>
                            <td><a href="{{ route('update_exam_page', ['id' => $el->exam_id]) }}" ><button class="table_btn">&#8635;</button></a></td>
                            <td><a href="#"><button class="table_btn">X</button></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
@endsection
