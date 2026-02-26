<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <title>Листи розсилки</title>
</head>
<body>
    <a href="{{ url('/') }}">← Назад</a>
    <h1>Листи розсилки</h1>

    <p>
        <a href="{{ url('/topics') }}">Теми</a>
        |
        <a href="{{ url('/newsletters/create') }}">+ Додати лист</a>
    </p>

    <p>Сортування:</p>
    <ul>
        <li><a href="{{ url('/newsletters?sort=sent_at&dir=desc') }}">Дата (новіші зверху)</a></li>
        <li><a href="{{ url('/newsletters?sort=sent_at&dir=asc') }}">Дата (старіші зверху)</a></li>
        <li><a href="{{ url('/newsletters?sort=subject&dir=asc') }}">Тема (A→Z)</a></li>
        <li><a href="{{ url('/newsletters?sort=subject&dir=desc') }}">Тема (Z→A)</a></li>
        <li><a href="{{ url('/newsletters?sort=topic_id&dir=asc') }}">Тема розсилки (topic_id)</a></li>
    </ul>

    @if ($newsletters->isEmpty())
        <p>Поки що немає листів.</p>
    @else
        <ul>
            @foreach ($newsletters as $n)
                <li style="margin-bottom: 16px;">
                    <div>
                        <strong>{{ $n->subject }}</strong>
                        — тема: {{ $n->topic?->title ?? '—' }}
                        @if ($n->sent_at)
                            — дата: {{ $n->sent_at->format('d.m.Y H:i') }}
                        @endif
                    </div>

                    <div style="margin-top: 6px;">
                        {{ $n->body }}
                    </div>

                    <div style="margin-top: 8px;">
                        <a href="{{ url('/newsletters/' . $n->id . '/edit') }}">Редагувати</a>

                        <form action="{{ url('/newsletters/' . $n->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Видалити</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>

        <div style="margin-top: 16px;">
            {{ $newsletters->links() }}
        </div>
    @endif
</body>
</html>
