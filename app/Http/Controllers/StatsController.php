<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use App\Models\Topic;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;

class StatsController extends Controller
{
    public function index(): View
    {
        $topicsTotal = Topic::query()->count();
        $newslettersTotal = Newsletter::query()->count();

        $beginMonth = Carbon::now()->startOfMonth();
        $endMonth = Carbon::now()->endOfMonth();

        $topicsLastMonth = Topic::query()
            ->whereBetween('created_at', [$beginMonth, $endMonth])
            ->count();

        $newslettersLastMonth = Newsletter::query()
            ->whereBetween('created_at', [$beginMonth, $endMonth])
            ->count();

        $lastTopic = Topic::query()->latest('created_at')->first();

        $topTopicByLetters = Topic::query()
            ->withCount('newsletters')
            ->orderByDesc('newsletters_count')
            ->first();

        return view('stats.index', compact(
            'topicsTotal',
            'newslettersTotal',
            'topicsLastMonth',
            'newslettersLastMonth',
            'lastTopic',
            'topTopicByLetters',
            'beginMonth',
            'endMonth'
        ));
    }
}
