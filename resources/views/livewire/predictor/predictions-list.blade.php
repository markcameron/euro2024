<?php

use App\Models\Fixture;
use Livewire\Volt\Component;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;

new class extends Component
{
    public function with(): array
    {
        return [
            'fixtures' => Fixture::with(['homeTeam', 'awayTeam', 'userPrediction'])->orderBy('date')->get()->groupBy('stage'),
        ];
    }

    public function predictionDetail(Fixture $fixture): void
    {
        $this->redirect($fixture->url_prediction);
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

            @foreach ($fixtures as $stage => $stageFixtures)
                <div class="my-6">
                    <h3 class="mb-2 font-bold font-xl text-gray">{{ $stage }}</h3>
                    @foreach ($stageFixtures as $fixture)
                        <div wire:click="predictionDetail({{ $fixture }})" class="cursor-pointer">
                            <div v-for="fixture in stageFixtures" class="mb-2 py-2 px-4 rounded-lg bg-white border border-white font-bold">
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

        </div>
    </div>
</section>
