<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <title>Теми розсилки</title>
</head>
<body>
    <h1>Теми розсилки</h1>

    <ul>
        @foreach ($topics as $topic)
            <li>
                <a href="{{ url('/topics/' . $topic->id) }}">
                    {{ $topic->title }}
                </a>
                — передплатників: {{ $topic->subscribers_count }}
                — листів: {{ $topic->newsletters_count }}
            </li>
        @endforeach
    </ul>
</body>
</html>
