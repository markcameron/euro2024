<?php

use function Livewire\Volt\{state};
use function Livewire\Volt\{computed};
use function Livewire\Volt\{on};
use App\Models\Fixture;

state([
    'displayFixture' => null,
]);

$fixtures = computed(function () {
    return Fixture::with(['homeTeam', 'awayTeam', 'userPrediction'])->orderBy('date')->get()->groupBy('stage');
});

$predictionDetail = fn (Fixture $fixture) => $this->displayFixture = $fixture;

on(['closePrediction' => function () {
    $this->displayFixture = null;
}]);

?>

<section>

    <div class="py-2 px-4">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if ($displayFixture)

                <livewire:predictor.predictions-detail :fixture="$displayFixture" />

            @else

                @foreach ($this->fixtures as $stage => $stageFixtures)
                    <div class="my-6">
                        <h3 class="mb-2 font-bold font-xl text-euro-light">{{ $stage }}</h3>
                        @foreach ($stageFixtures as $fixture)
                            <div wire:click="predictionDetail({{ $fixture }})" class="cursor-pointer">
                                <div v-for="fixture in stageFixtures" class="mb-2 py-2 px-4 rounded-lg bg-euro-dark border border-euro-dark font-bold text-euro-light">
                                    <div class="flex flex-row">
                                        <div class="mr-4 flex items-center"></div>
                                        <div class="flex flex-grow items-center">{{ $fixture->homeTeam->name }}</div>
                                        <div class="w-16 uppercase text-center">{{ $fixture->userPrediction ? $fixture->userPrediction->score_home : '-' }}</div>
                                    </div>
                                    <div class="flex flex-row">
                                        <div class="mr-4 flex items-center"></div>
                                        <div class="flex flex-grow items-center">{{ $fixture->awayTeam->name }}</div>
                                        <div class="w-16 uppercase text-center">{{ $fixture->userPrediction ? $fixture->userPrediction->score_away : '-' }}</div>
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
