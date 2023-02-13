<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>Тестирование Админ панель</title>
</head>
<body>
<header>
    <div class="content_header">
        <h1><a style="color: white; text-decoration: none;" href="@yield('href_home')">Тестирование</a> @yield('who')</h1>
        <form action="{{ route('logout') }}" method="GET">
            @csrf
            <button>Выход</button>
        </form>
    </div>
</header>
<div class="container">
    <div class="side-bar">
        @yield('side-bar')
    </div>
    <div class="main">
        @yield('content')
    </div>
</div>
<script src="/assets/scripts/js/code_for_topic_question.js"></script>
<script src="/assets/scripts/js/code_delete_notification.js"></script>
<script src="/assets/scripts/js/code_for_passing_exam.js"></script>
</body>
</html>
