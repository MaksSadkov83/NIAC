@extends('layouts.admin')

@section('href_home')@endsection

@section('who')> Тест: {{ $exam_text }}@endsection

@section('side-bar')
    <div class="container_side-bar">
        <ul id="questions_menu">
        </ul>
    </div>
@endsection

@section('content')
    <div class="slider">
        <form action="" class="form_slide">
            <input type="hidden" id="{{ $exam_id }}" class="exam">
            <div class="slides">
            </div>
        </form>
    </div>
    <div class="time">12:00</div>
    <div class="menu_for_add_delete_edit">
        <div id="question_number">1 / 30</div>
        <button onclick="End_exam(event)" id="end_btn">Завершить</button>
        <button onclick="Delay(event)" id="back_btn">Назад</button>
        <button onclick="Delay(event)" id="next_btn">Следующий</button>
    </div>
@endsection
