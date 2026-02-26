<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <title>Головна</title>
</head>
<body>
    <h1>Система розсилки</h1>

    <ul>
        <li>
            <a href="{{ url('/topics') }}">Переглянути теми</a>
        </li>

        <li>
            <a href="{{ url('/newsletters') }}">Переглянути листи</a>
        </li>

        <li>
            <a href="{{ url('/newsletters/create') }}">Додати новий лист</a>
        </li>
    </ul>
</body>
</html>
