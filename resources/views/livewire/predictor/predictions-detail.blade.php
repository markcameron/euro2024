<?php

use App\Models\Fixture;
use App\Models\Prediction;
use Livewire\Volt\Component;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;

new class extends Component
{
    public $fixture;
    public $prediction;

    public function mount(Fixture $fixture): void
    {
        $this->fixture = $fixture;

        $this->prediction = Prediction::firstOrCreate([
            'user_id' => auth()->user()->id,
            'fixture_id' => $fixture->id,
        ]);

        $this->prediction->score_home = $this->prediction->score_home ?? 0;
        $this->prediction->score_away = $this->prediction->score_away ?? 0;

        $this->dispatch('$refresh');
    }

    public function increaseScore(string $team): void
    {
        $this->prediction->increaseScore($team);
    }

    public function decreaseScore(string $team): void
    {
        $this->prediction->decreaseScore($team);
    }
};

?>

<section class="space-y-6">
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Matches') }}
        </h2>
    </template>


    <div class="py-2 px-4">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-lg">
                <div class="p-4">

                    <x-banner-danger :show="!$prediction->fixture->can_predict">Predictions for this match are closed</x-banner-danger>

                    <p class="mb-2 uppercase tracking-wide text-sm font-bold text-gray-700">{{ $fixture->date->timezone('Europe/Zurich')->format('l F jS - H:i') }}</p>
                    <div class="text-3xl text-gray-900 flex flex-row">
                        <div class="mr-3 flex items-center"></div>
                        <div class="flex-grow">{{ $prediction->fixture->homeTeam->name }}</div>
                        @if ($fixture->can_predict)
                        <div class="w-8 flex items-center justify-center cursor-pointer" wire:click="decreaseScore('home')">
                            -
                        </div>
                        @endif
                        <div class="w-8 flex justify-center">
                            {{ $prediction->score_home }}
                        </div>
                        @if ($fixture->can_predict)
                        <div class="w-8 flex items-center justify-center cursor-pointer" wire:click="increaseScore('home')">
                            +
                        </div>
                        @endif
                    </div>
                    <div class="text-3xl text-gray-900 flex flex-row">
                        <div class="mr-3 flex items-center"></div>
                        <div class="flex-grow">{{ $prediction->fixture->awayTeam->name }}</div>
                        @if ($fixture->can_predict)
                        <div class="w-8 flex items-center justify-center cursor-pointer" wire:click="decreaseScore('away')">
                            -
                        </div>
                        @endif
                        <div class="w-8 flex justify-center">
                            {{ $prediction->score_away }}
                        </div>
                        @if ($fixture->can_predict)
                        <div class="w-8 flex items-center justify-center cursor-pointer" wire:click="increaseScore('away')">
                            +
                        </div>
                        @endif
                    </div>
                    <p class="mt-2 text-gray-500 tracking-tighter uppercase text-sm">{{ $fixture->venue->name }} - {{ $fixture->venue->city }}</p>
                </div>
            </div>

        </div>
    </div>

</section>
