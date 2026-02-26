<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use App\Models\Topic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class NewsletterController extends Controller
{
    public function index(Request $request): View
    {
        $allowedSort = ['id', 'subject', 'sent_at', 'topic_id', 'created_at'];
        $sort = $request->query('sort', 'sent_at');
        $dir = strtolower($request->query('dir', 'desc')) === 'asc' ? 'asc' : 'desc';

        if (!in_array($sort, $allowedSort, true)) {
            $sort = 'sent_at';
        }

        $newsletters = Newsletter::query()
            ->with('topic')
            ->orderBy($sort, $dir)
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('newsletters.index', compact('newsletters', 'sort', 'dir'));
    }

    public function create(): View
    {
        $topics = Topic::query()->orderBy('title')->get();

        return view('newsletters.create', compact('topics'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'topic_id' => ['required', 'integer', 'exists:topics,id'],
            'subject' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'sent_at' => ['nullable', 'date'],
        ]);

        Newsletter::query()->create($data);

        return redirect('/newsletters');
    }

    public function edit(Newsletter $newsletter): View
    {
        $topics = Topic::query()->orderBy('title')->get();

        return view('newsletters.edit', compact('newsletter', 'topics'));
    }

    public function update(Request $request, Newsletter $newsletter): RedirectResponse
    {
        $data = $request->validate([
            'topic_id' => ['required', 'integer', 'exists:topics,id'],
            'subject' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'sent_at' => ['nullable', 'date'],
        ]);

        $newsletter->update($data);

        return redirect('/newsletters');
    }

    public function destroy(Newsletter $newsletter): RedirectResponse
    {
        $newsletter->delete();

        return redirect('/newsletters');
    }
}
