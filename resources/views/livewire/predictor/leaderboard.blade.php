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
    return User::with(['predictions.fixture'])->get()->sortByDesc('leaderboard_sort');
});

$toggleStats = fn () => $this->showStats =! $this->showStats;

?>

<section class="space-y-6">

    <div class="py-2 px-4">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <x-toggle label="Stats"></x-toggle>

            <div class="bg-white rounded-lg py-2">

                @foreach ($this->users as $position => $user)
                    <div class="border-b border-gray-300 last:border-b-0">

                        <div class="py-4 pr-4 py-2 flex items-center">
                            <div class="w-8 mx-1 flex-shrink-0 font-bold text-grey-900 text-2xl text-center">{{ $position + 1 }}</div>
                            <div class="flex-grow">
                                <p class="font-bold text-gray-900">{{ $user->nickname ?? $user->name }}</p>
                                <p class="text-sm text-gray-700">{{ $user->catchphrase }}</p>
                                @if ($user->nickname)
                                    <p class="text-sm text-gray-700">{{ $user->name }}</p>
                                @endif
                            </div>
                            <div class="w-14 flex-shrink-0 text-2xl font-bold text-right">
                                {{ $user->score }}
                            </div>
                        </div>

                        @if ($this->showStats)
                            <div class="border-t border-gray-200 p-2 bg-gray-50 flex justify-around">
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
                @endforeach

            </div>

        </div>
    </div>
</section>
