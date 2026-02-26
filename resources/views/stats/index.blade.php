<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <title>Статистика</title>
</head>
<body>
    <a href="{{ url('/') }}">← Назад</a>
    <h1>Статистика сайту</h1>

    <ul>
        <li>Кількість записів у topics: <strong>{{ $topicsTotal }}</strong></li>
        <li>Кількість записів у newsletters: <strong>{{ $newslettersTotal }}</strong></li>
        <li>Записів у topics за поточний місяць: <strong>{{ $topicsLastMonth }}</strong></li>
        <li>Записів у newsletters за поточний місяць: <strong>{{ $newslettersLastMonth }}</strong></li>
    </ul>

    <h2>Останній запис у topics</h2>
    @if ($lastTopic)
        <p><strong>{{ $lastTopic->title }}</strong> (id={{ $lastTopic->id }})</p>
    @else
        <p>Немає записів.</p>
    @endif

    <h2>Тема з найбільшою кількістю листів</h2>
    @if ($topTopicByLetters)
        <p>
            <strong>{{ $topTopicByLetters->title }}</strong>
            — листів: <strong>{{ $topTopicByLetters->newsletters_count }}</strong>
        </p>
    @else
        <p>Немає даних.</p>
    @endif

    <p>
        <a href="{{ url('/search') }}">Перейти до пошуку</a>
    </p>
</body>
</html>
