<?php

use function Livewire\Volt\{state};

state([
    'fixture' => null,
]);

?>

<section class="flex flex-col gap-6 mt-4">

    <button wire:click="$dispatch('closeMatch')" class="w-8 text-euro font-bold">
        <svg xmlns="http://www.w3.org/2000/svg" classname="h-4" fill="currentColor" viewBox="4 5.01 12 9.99">
            <path fillrule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" cliprule="evenodd"></path>
        </svg>
    </button>

    <div class="max-w-5xl sm:px-6 lg:px-8">

        <div class="py-6 px-7 bg-euro-dark rounded-4xl text-euro-light">

            <div class="">
                <p class="mb-2 uppercase tracking-wide text-sm text-euro font-bold">{{ $fixture->date->timezone('Europe/Zurich')->format('l F jS - H:i') }}</p>
                <div class="text-3xl flex flex-row">
                    <div class="flex-grow">{{ $fixture->homeTeam->name }}</div>
                    <div class="w-8">{{ $fixture->started ? $fixture->goals_home->count() : '' }}</div>
                </div>
                <div class="text-3xl flex flex-row">
                    <div class="flex-grow">{{ $fixture->awayTeam->name }}</div>
                    <div class="w-8">{{ $fixture->started ? $fixture->goals_away->count() : '' }}</div>
                </div>
                <p class="mt-2 tracking-tighter uppercase text-sm text-euro">{{ $fixture->venue->name }} - {{ $fixture->venue->city }}</p>
            </div>

        </div>
    </div>

</section>
