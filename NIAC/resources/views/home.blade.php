@extends('layouts.app_home')

@section('home_content')
    <div class="btn_avtorization_registration">
        <div class="btn_reg_avto">
            <img src="/public/assets/svg/avto.svg" id="svg_reg_avto">
        </div>
        <button class="btn_avto_reg_text">Авторизация</button>
    </div>

    <div class="show_window">
        <div class="two_form">
            <form action="{{ route('login') }}" method="POST" id="form_avtorization">
                @csrf
                <div class="div_form">
                    <div class="header_form">
                        Авторизация
                    </div>
                    Идентифиционные номер:
                    <input type="text" name="id" id="id">
                    Пароль:
                    <input type="password" name="password" id="password">
                </div>
                <button type="submit" class="brn_reg_avto_sumbit">Авторизироваться</button>
            </form>
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

{{--    <form action="{{ route('registration') }}" method="POST" id="form_registration">--}}
{{--        @csrf--}}
{{--        <div class="div_form">--}}
{{--            <div class="header_form">--}}
{{--                Регистрация--}}
{{--            </div>--}}
{{--            ФИО:--}}
{{--            <input type="text" id="user_name" name="user_name">--}}
{{--            Номер телефона:--}}
{{--            <input type="text" id="telephon_number" name="telephon_number">--}}
{{--            Пароль:--}}
{{--            <input type="password" id="password" name="password">--}}
{{--            Роль:--}}
{{--            <input type="text" id="role_user" name="role_user">--}}
{{--            Автивен/Неактивен:--}}
{{--            <input type="hidden" id="active_user" name="active_user" value="0">--}}
{{--            <input type="checkbox" id="active_user" name="active_user" value="1">--}}
{{--        </div>--}}
{{--        <button type="submit" class="brn_reg_avto_sumbit">Зарегистрироваться</button>--}}
{{--    </form>--}}


@endsection
