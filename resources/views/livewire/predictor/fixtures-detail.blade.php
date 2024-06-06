<?php

use function Livewire\Volt\{state};

state([
    'fixture' => null,
]);

?>

<section class="space-y-6">

    <button wire:click="$dispatch('closeMatch')" class="w-10 mb-4 text-white font-bold">
        <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fillRule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clipRule="evenodd" />
        </svg>
    </button>

    <div class="py-2 px-4">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-lg">

                <div class="p-4">
                    <p class="mb-2 uppercase tracking-wide text-sm font-bold text-gray-700">{{ $fixture->date->timezone('Europe/Zurich')->format('l F jS - H:i') }}</p>
                    <div class="text-3xl text-gray-900 flex flex-row">
                        <div class="mr-3 flex items-center"></div>
                        <div class="flex-grow">{{ $fixture->homeTeam->name }}</div>
                        <div class="w-8">{{ $fixture->started ? $fixture->goals_home->count() : '' }}</div>
                    </div>
                    <div class="text-3xl text-gray-900 flex flex-row">
                        <div class="mr-3 flex items-center"></div>
                        <div class="flex-grow">{{ $fixture->awayTeam->name }}</div>
                        <div class="w-8">{{ $fixture->started ? $fixture->goals_away->count() : '' }}</div>
                    </div>
                    <p class="mt-2 text-gray-500 tracking-tighter uppercase text-sm">{{ $fixture->venue->name }} - {{ $fixture->venue->city }}</p>
                </div>

            </div>
        </div>

    </div>

</section>
