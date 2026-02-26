<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <title>Пошук</title>
</head>
<body>
    <a href="{{ url('/') }}">← Назад</a>
    <h1>Пошук по сайту</h1>

    <h2>Пошук за ключовим словом</h2>
    <form method="GET" action="{{ url('/search') }}">
        <input type="hidden" name="type" value="keyword">
        <input type="text" name="q" value="{{ $type === 'keyword' ? $q : '' }}" placeholder="Наприклад: Laravel">
        <button type="submit">Шукати</button>
    </form>

    <h2>Пошук за шаблоном (використовуйте *)</h2>
    <form method="GET" action="{{ url('/search') }}">
        <input type="hidden" name="type" value="pattern">
        <input type="text" name="q" value="{{ $type === 'pattern' ? $q : '' }}" placeholder="Наприклад: Нов*">
        <button type="submit">Шукати</button>
    </form>

    <h2>Пошук у діапазоні дат (sent_at)</h2>
    <form method="GET" action="{{ url('/search') }}">
        <input type="hidden" name="type" value="range">
        <input type="date" name="from" value="{{ $type === 'range' ? $from : '' }}">
        <input type="date" name="to" value="{{ $type === 'range' ? $to : '' }}">
        <button type="submit">Шукати</button>
    </form>

    <hr>

    @if ($type === 'range')
        <h2>Результати (листів знайдено: {{ $newsletters->count() }})</h2>
    @else
        <h2>Результати тем (topics): {{ $topics->count() }}</h2>
        <h2>Результати листів (newsletters): {{ $newsletters->count() }}</h2>
    @endif

    @if ($topics->isNotEmpty())
        <h3>Topics</h3>
        <ul>
            @foreach ($topics as $t)
                <li>{{ $t->title }} (id={{ $t->id }})</li>
            @endforeach
        </ul>
    @endif

    @if ($newsletters->isNotEmpty())
        <h3>Newsletters</h3>
        <ul>
            @foreach ($newsletters as $n)
                <li style="margin-bottom: 12px;">
                    <div>
                        <strong>{{ $n->subject }}</strong>
                        — тема: {{ $n->topic?->title ?? '—' }}
                        @if ($n->sent_at)
                            — {{ $n->sent_at->format('d.m.Y H:i') }}
                        @endif
                    </div>
                    <div>{{ $n->body }}</div>
                </li>
            @endforeach
        </ul>
    @else
        <p>Нічого не знайдено.</p>
    @endif

    <p><a href="{{ url('/stats') }}">← До статистики</a></p>
</body>
</html>
