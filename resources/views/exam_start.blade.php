@extends('layouts.admin')

@section('href_home')@endsection

@section('who')> Тест: {{ $exam_text }}@endsection

@section('side-bar')
    <div class="container_side-bar" id="{{ $exam_id }}">
        <ul>
            <li id="question_1">1 Вопрос</li>
            <li>2 Вопрос</li>
            <li>3 Вопрос</li>
            <li>4 Вопрос</li>
            <li>5 Вопрос</li>
            <li>6 Вопрос</li>
            <li>7 Вопрос</li>
            <li>8 Вопрос</li>
            <li>9 Вопрос</li>
            <li>10 Вопрос</li>
            <li>11 Вопрос</li>
            <li>12 Вопрос</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="slider">
        <form action="">
            <div class="slides">
                <div class="slide" id="slide_1">
                    <div class="container_slide">
                        <div class="text_question">
                            1. Является ли человек животным ?
                        </div>
                        <ul class="list_answer">
                            <li><input type="radio" name="answer" id="yes"><label for="yes">Да</label></li>
                            <li><input type="radio" name="answer" id="no"><label for="no">Нет</label></li>
                            <li><input type="radio" name="answer" id="dont_know"><label for="dont_know">Не знаю</label></li>
                        </ul>
                    </div>
                </div>
                <div class="slide">2</div>
                <div class="slide">3</div>
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
