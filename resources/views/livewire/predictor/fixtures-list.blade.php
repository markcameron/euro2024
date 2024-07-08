<?php

use App\Models\Fixture;
use function Livewire\Volt\{on};
use function Livewire\Volt\{state};
use function Livewire\Volt\{computed};

state([
    'fixture' => null,
]);

$sortOrder = computed(function () {
    return collect([
        'Final',
        '3rd Place Final',
        'Semi-finals',
        'Quarter-finals',
        'Round of 16',
        'Group',
    ]);
});

$fixtures = computed(function () {
    return Fixture::with(['homeTeam', 'awayTeam'])->orderByRaw('FIND_IN_SET(stage, "' . $this->sortOrder->implode(',') . '")')->orderBy('date')->get();
});

$todaysFixtures = computed(function () {
    return Fixture::with(['homeTeam', 'awayTeam'])->orderBy('date')->whereDate('date', today())->get();
});

on(['fixtureDetail' => function (Fixture $fixture) {
    $this->fixture = $fixture;
}]);

on(['closeMatch' => function () {
    $this->fixture = null;
}]);

?>

<section>

    <div class="px-4">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @if ($fixture)

                <livewire:predictor.fixtures-detail :fixture="$fixture" />

            @else

                <div class="mt-2">
                    <div class="flex flex-col gap-4">
                        @foreach ($this->todaysFixtures as $fixture)
                            <x-fixture-row :fixture="$fixture" />
                            @if ($loop->last)
                            <div class="h-8"></div>
                            @endif
                        @endforeach

                        @foreach ($this->fixtures as $fixture)
                            <x-fixture-row :fixture="$fixture" />
                        @endforeach
                    </div>
                </div>

            @endif

        </div>
    </div>
</section>
