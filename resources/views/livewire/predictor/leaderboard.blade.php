<?php

use function Livewire\Volt\{state};
use function Livewire\Volt\{computed};
use function Livewire\Volt\{on};
use App\Models\User;
use App\Enums\ScoreType;

state([
    'showStats' => false,
]);

$users = computed(function () {
    return User::with(['predictions.fixture'])->get()->sortByDesc('leaderboard_sort')->values();
});

$toggleStats = fn () => $this->showStats =! $this->showStats;

?>

<section class="space-y-6">

    <div class="py-2 px-4">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <x-toggle label="Stats"></x-toggle>

            <div class="flex flex-col gap-4">

                @foreach ($this->users as $position => $user)
                    <div class="bg-euro-dark rounded-4xl py-2 px-2 text-euro-light">

                        <div class="px-2 mb-1">
                            <div class="flex items-center">
                                <div class="w-8 mr-2 flex-shrink-0 font-bold text-2xl text-center">{{ $position + 1 }}</div>
                                <div class="flex-grow">
                                    <p class="font-bold">
                                        {{ $user->nickname ?? $user->name }}
                                        @if ($user->nickname)
                                        <span class="text-xs text-euro">({{ $user->name }})</p>
                                        @endif
                                    </p>
                                    <p class="text-sm text-euro">{{ $user->catchphrase }}</p>

                                </div>
                                <div class="w-14 flex-shrink-0 text-2xl font-bold text-right mr-4">
                                    {{ $user->score }}
                                </div>
                            </div>

                            @if ($this->showStats)
                                <div class="p-2 mt-1 bg-euro flex justify-around rounded-3xl bg-euro-darkest ">
                                    <x-leaderboard-stat type="ES">
                                        {{ $user->prediction_stats->get(ScoreType::ExactScore->value)?->count() ?? 0 }}
                                    </x-leaderboard-stat>
                                    <x-leaderboard-stat type="GD">
                                        {{ $user->prediction_stats->get(ScoreType::GoalDifference->value)?->count() ?? 0 }}
                                    </x-leaderboard-stat>
                                    <x-leaderboard-stat type="W">
                                        {{ $user->prediction_stats->get(ScoreType::Winner->value)?->count() ?? 0 }}
                                    </x-leaderboard-stat>
                                    <x-leaderboard-stat type="L">
                                        {{ $user->prediction_stats->get(ScoreType::Loser->value)?->count() ?? 0 }}
                                    </x-leaderboard-stat>
                                </div>
                            @endif
                        </div>

                    </div>
                @endforeach

            </div>

        </div>
    </div>
</section>
