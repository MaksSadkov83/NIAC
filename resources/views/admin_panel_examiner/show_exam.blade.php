@extends('.layouts.admin')

@section('href_home'){{ route('admin_panel_examiner') }}@endsection

@section('who') > {{ \Illuminate\Support\Facades\Auth::id() }}@endsection

@section('exam')<span style="color: #3c8bff; margin-left: -15px; position: absolute;">></span>@endsection

@section('side-bar')
    <div class="container_side-bar">
        <a href="{{ route('show_exam') }}">@yield('exam')Тесты</a>
        <a href="{{ route('admin_panel_examiner_show_users') }}">@yield('users')Пользователи</a>
    </div>
@endsection

@section('content')
    <div class="container_table_and_student">
        <form class="form_add_student" action="{{ route('add_exam') }}" method="POST" id="form_add_group">
            @if(session('error'))
                {{ session('error') }}
            @endif
            @csrf
            <h2 style="margin-bottom: 50px;">
                <span style="color: #3c8bff;">></span> Добавить Тест:
            </h2>
            Название теста:
            <input type="text" name="exam_text" id="exam_text">

            <input type="hidden" value="{{ \Illuminate\Support\Facades\Auth::id() }}" name="editor_id" id="editor_id">

            <button class="add_btn" type="submit">Добавить</button>
        </form>
        <div class="container_table">
            <table id="table_for_all">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Автор</th>
                    <th>Название теста</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($data as $el)
                        <tr>
                            <td>{{ $el->id}}</td>
                            <td>{{ $el->name }}</td>
                            <td>{{ $el->text_ }}</td>
                            <td><a href="#"><button class="table_btn">&#8635;</button></a></td>
                            <td><a href="#"><button class="table_btn">X</button></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
