<?php

use function Livewire\Volt\{state};
use function Livewire\Volt\{computed};
use function Livewire\Volt\{on};
use App\Models\Fixture;

state([
    'fixture' => null,
]);

$fixtures = computed(function () {
    return Fixture::with(['homeTeam', 'awayTeam'])->orderBy('date')->get()->groupBy('stage');
});

$fixtureDetail = fn (Fixture $fixture) => $this->fixture = $fixture;

on(['closeMatch' => function () {
    $this->fixture = null;
}]);

?>

<section>

    <div class="py-2 px-4">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if ($fixture)

                <livewire:predictor.fixtures-detail :fixture="$fixture" />

            @else

                @foreach ($this->fixtures as $stage => $stageFixtures)
                    <div class="mt-2">
                        <h3 class="mb-2 font-bold font-xl text-euro-light">{{ $stage }}</h3>
                        @foreach ($stageFixtures as $fixture)
                            <div wire:click="fixtureDetail({{ $fixture }})" class="cursor-pointer">
                                <div v-for="fixture in stageFixtures" class="mb-2 py-2 px-4 rounded-lg bg-euro-dark border border-euro-dark font-bold text-euro-light">
                                    <div class="flex flex-row">
                                        <div class="mr-4 flex items-center"></div>
                                        <div class="flex flex-grow items-center">{{ $fixture->homeTeam->name }}</div>
                                        @if ($fixture->started)
                                        <div class="w-16 uppercase text-center">{{ $fixture->goals_home->count() }}</div>
                                        @else
                                        <div class="w-16 uppercase text-center">{{ $fixture->date->format('D d') }}</div>
                                        @endif
                                    </div>
                                    <div class="flex flex-row">
                                        <div class="mr-4 flex items-center"></div>
                                        <div class="flex flex-grow items-center">{{ $fixture->awayTeam->name }}</div>
                                        @if ($fixture->started)
                                        <div class="w-16 uppercase text-center">{{ $fixture->goals_away->count() }}</div>
                                        @else
                                        <div class="w-16 uppercase text-center">{{ $fixture->date->timezone('Europe/Zurich')->format('H:i') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach

            @endif

        </div>
    </div>
</section>
