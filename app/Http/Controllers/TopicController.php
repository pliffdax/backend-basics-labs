<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Contracts\View\View;

class TopicController extends Controller
{
    public function index(): View
    {
        $topics = Topic::query()
            ->withCount(['subscribers', 'newsletters'])
            ->orderBy('title')
            ->get();

        return view('topics.index', compact('topics'));
    }

    public function show(Topic $topic): View
    {
        $topic->load([
            'subscribers' => fn($q) => $q->orderBy('name'),
            'newsletters' => fn($q) => $q->orderByDesc('sent_at')->orderByDesc('id'),
        ]);

        return view('topics.show', compact('topic'));
    }
}
