<?php

namespace Database\Seeders;

use App\Models\Subscriber;
use App\Models\Topic;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Newsletter;
use Illuminate\Support\Carbon;

class Lab1Seeder extends Seeder
{
    public function run(): void
    {
        $topics = collect([
            'Акції та знижки',
            'Новини про оновлення',
            'Нагадування про оплату',
            'Важливі оголошення',
        ])->map(fn($t) => Topic::query()->create(['title' => $t]));

        $subscribers = collect([
            ['name' => 'Ivan Petrenko', 'email' => 'ivan@example.com', 'login' => 'ivan'],
            ['name' => 'Olena Kovalenko', 'email' => 'olena@example.com', 'login' => 'olena'],
            ['name' => 'Andrii Shevchenko', 'email' => 'andrii@example.com', 'login' => 'andrii'],
            ['name' => 'Iryna Melnyk', 'email' => 'iryna@example.com', 'login' => 'iryna'],
            ['name' => 'Dmytro Bondar', 'email' => 'dmytro@example.com', 'login' => 'dmytro'],
        ])->map(fn($s) => Subscriber::query()->create([
            ...$s,
            'password_hash' => Hash::make('password123'),
        ]));

        foreach ($subscribers as $s) {
            $s->topics()->attach($topics->random(rand(1, 3))->pluck('id')->all());
        }

        $now = Carbon::now();

        foreach ($topics as $t) {
            $count = rand(2, 4);

            for ($i = 1; $i <= $count; $i++) {
                Newsletter::query()->create([
                    'topic_id' => $t->id,
                    'subject' => $t->title . " — лист №{$i}",
                    'body' => "Приклад змісту листа для теми «{$t->title}». Тестове повідомлення №{$i}.",
                    'sent_at' => $now->copy()->subDays(rand(0, 30))->setTime(rand(8, 20), rand(0, 59)),
                ]);
            }
        }
    }
}
