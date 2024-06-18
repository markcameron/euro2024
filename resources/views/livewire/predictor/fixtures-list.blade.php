<?php

use function Livewire\Volt\{state};
use function Livewire\Volt\{computed};
use function Livewire\Volt\{on};
use App\Models\Fixture;

state([
    'fixture' => null,
]);

$fixtures = computed(function () {
    return Fixture::with(['homeTeam', 'awayTeam'])->orderBy('date')->get();
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
