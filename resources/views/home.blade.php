@extends('layouts.app_home')

@section('home_content')
    <div class="btn_avtorization_registration">
        <div class="btn_reg_avto">
            <img src="/assets/svg/avto.svg" id="svg_reg_avto">
        </div>
        <button class="btn_avto_reg_text">Авторизация</button>
    </div>

    <div class="show_window">
        <div class="two_form">
            <form action="{{route('login')}}" method="POST" id="form_avtorization">
                @csrf
                <div class="div_form">
                    <div class="header_form">
                        Авторизация
                    </div>
                    Имя пользователя:
                    <input type="text" name="id" id="id">
                    Пароль:
                    <input type="password" name="password" id="password">
                </div>
                <button type="submit" class="brn_reg_avto_sumbit">Авторизироваться</button>
            </form>
        </div>
    </div>
    {{--            <form action="" id="form_registration">--}}
    {{--                <div class="div_form">--}}
    {{--                    <div class="header_form">--}}
    {{--                        Регистрация--}}
    {{--                    </div>--}}
    {{--                    Имя пользователя:--}}
    {{--                    <input type="text">--}}
    {{--                    Пароль:--}}
    {{--                    <input type="password">--}}
    {{--                </div>--}}
    {{--                <button type="submit" class="brn_reg_avto_sumbit">Зарегистрироваться</button>--}}
    {{--            </form>--}}

    {{--    <div class="notification">--}}
    {{--        <div class="field_message">--}}
    {{--            Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat quaerat at consequuntur, unde voluptas fuga, repellat molestias molestiae quasi--}}
    {{--        </div>--}}
    {{--        <div class="delete_notification">--}}
    {{--            +--}}
    {{--        </div>--}}
    {{--    </div>--}}
@endsection
