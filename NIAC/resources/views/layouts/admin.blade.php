<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/assets/css/style.css">
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
    <div class="main" style="
      width: calc(100% - 15%);
      max-width: calc(100% - 233px);
    ">
        @yield('content')
    </div>
</div>
<script src="/public/assets/scripts/js/code_for_topic_question.js"></script>
<script src="/public/assets/scripts/js/code_delete_notification.js"></script>
<script src="/public/assets/scripts/js/code_for_passing_exam.js"></script>
<script src="/public/assets/scripts/js/send_questions_and_options.js"></script>
<script src="/public/assets/scripts/js/code_for_create_exam.js"></script>
</body>
</html>
