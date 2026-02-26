<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use App\Models\Topic;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request): View
    {
        $type = $request->query('type', 'keyword');

        $q = trim((string) $request->query('q', ''));
        $from = $request->query('from');
        $to = $request->query('to');

        $topics = collect();
        $newsletters = collect();

        if ($type === 'range' && $from && $to) {
            $fromDt = Carbon::parse($from)->startOfDay();
            $toDt = Carbon::parse($to)->endOfDay();

            $newsletters = Newsletter::query()
                ->with('topic')
                ->whereNotNull('sent_at')
                ->whereBetween('sent_at', [$fromDt, $toDt])
                ->orderByDesc('sent_at')
                ->get();
        } elseif ($q !== '') {
            $like = $type === 'pattern'
                ? str_replace('*', '%', $q)
                : '%' . $q . '%';

            $topics = Topic::query()
                ->where('title', 'like', $like)
                ->orderBy('title')
                ->get();

            $newsletters = Newsletter::query()
                ->with('topic')
                ->where(function ($qb) use ($like) {
                    $qb->where('subject', 'like', $like)
                       ->orWhere('body', 'like', $like);
                })
                ->orderByDesc('id')
                ->get();
        }

        return view('search.index', compact('type', 'q', 'from', 'to', 'topics', 'newsletters'));
    }
}
