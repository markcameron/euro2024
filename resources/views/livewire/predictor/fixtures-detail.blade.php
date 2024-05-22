<?php

use App\Models\Fixture;
use Livewire\Volt\Component;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;

new class extends Component
{
    public $fixture;

    public function mount(Fixture $fixture): void
    {
        $this->fixture = $fixture;
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
