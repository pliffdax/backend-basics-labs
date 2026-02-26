<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <title>Система розсилки</title>
</head>
<body>
    <h1>Система розсилки</h1>

    <h2>Листування</h2>
    <ul>
        <li><a href="{{ url('/topics') }}">Переглянути теми</a></li>
        <li><a href="{{ url('/newsletters') }}">Переглянути листи</a></li>
        <li><a href="{{ url('/newsletters/create') }}">Додати новий лист</a></li>
    </ul>

    <h2>Статистика та пошук</h2>
    <ul>
        <li><a href="{{ url('/stats') }}">Статистика сайту</a></li>
        <li><a href="{{ url('/search') }}">Пошук по сайту</a></li>
    </ul>
</body>
</html>
