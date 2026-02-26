<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <title>Додати лист</title>
</head>
<body>
    <a href="{{ url('/newsletters') }}">← Назад</a>
    <h1>Додати лист</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ url('/newsletters') }}" method="POST">
        @csrf

        <p>
            <label>Тема розсилки:</label><br>
            <select name="topic_id" required>
                @foreach ($topics as $t)
                    <option value="{{ $t->id }}">{{ $t->title }}</option>
                @endforeach
            </select>
        </p>

        <p>
            <label>Subject:</label><br>
            <input type="text" name="subject" value="{{ old('subject') }}" required>
        </p>

        <p>
            <label>Body:</label><br>
            <textarea name="body" rows="6" cols="60" required>{{ old('body') }}</textarea>
        </p>

        <p>
            <label>Sent at (optional):</label><br>
            <input type="datetime-local" name="sent_at" value="{{ old('sent_at') }}">
        </p>

        <button type="submit">Зберегти</button>
    </form>
</body>
</html>
