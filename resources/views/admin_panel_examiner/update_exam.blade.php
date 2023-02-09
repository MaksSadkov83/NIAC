@extends('.layouts.admin')

@section('href_home'){{ route('admin_panel_examiner') }}@endsection

@section('who')  > {{ \Illuminate\Support\Facades\Auth::id() }}@endsection

@section('exam')<span style="color: #3c8bff; margin-left: -15px; position: absolute;">></span>@endsection

@section('side-bar')
    <div class="container_side-bar">
        <a href="{{ route('show_exam') }}">@yield('exam')Тесты</a>
        <a href="{{ route('admin_panel_examiner_show_users') }}">@yield('users')Пользователи</a>
    </div>
@endsection

@section('content')
    <form class="form_add_student" action="{{ route('update_exam', ['id' => $id]) }}" method="POST" id="form_add_group">
        @csrf
        <h2 style="margin-bottom: 50px;">
            <span style="color: #3c8bff;">></span> Обновить тест <span style="color: #3c8bff;">></span> {{ $data->text_ }}:
        </h2>
        Название теста (Если не хотите менять пропустите поле):
        <input type="text" name="exam_text" id="exam_text" value="{{ $data->text_ }}">

        <input type="hidden" value="" name="exam_id" id="exam_id">

        <button class="add_btn" type="submit">Обновить</button>
    </form>
@endsection


