<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <title>{{ $topic->title }}</title>
</head>
<body>
    <a href="{{ url('/topics') }}">← Назад</a>
    <h1>{{ $topic->title }}</h1>

    <h2>Передплатники</h2>
    <ul>
        @foreach ($topic->subscribers as $s)
            <li>
                {{ $s->name }} ({{ $s->email }}) — логін: <strong>{{ $s->login }}</strong>
            </li>
        @endforeach
    </ul>

    <h2>Листи розсилки</h2>

    @if ($topic->newsletters->isEmpty())
        <p>Для цієї теми ще немає листів.</p>
    @else
        <ul>
            @foreach ($topic->newsletters as $n)
                <li style="margin-bottom: 16px;">
                    <div>
                        <strong>{{ $n->subject }}</strong>
                        @if ($n->sent_at)
                            — дата: {{ $n->sent_at->format('d.m.Y H:i') }}
                        @endif
                    </div>
                    <div style="margin-top: 4px;">
                        {{ $n->body }}
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</body>
</html>
