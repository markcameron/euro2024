<?php

use function Livewire\Volt\{state,on};

state(['selectedTab' => 1]);

$selectTab = fn ($tab) => $this->selectedTab = $tab;

on(['selectTabEvent' => function ($tab) {
    $this->selectedTab = $tab;
}]);

?>

<div class="flex flex-col h-screen justify-between">

    <header class="h-18 bg-euro-darkest">
        <livewire:layout.navigation />
    </header>

    <main class="overflow-y-auto mb-auto flex-grow bg-euro-darkest from-euro-darkest to-euro-light" id="scrollable">

        <div wire:loading.flex class="text-white h-96 flex items-center justify-center">
            <svg class="animate-spin -ml-1 mr-3 h-16 w-16 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-30" cx="12" cy="12" r="10" stroke="white" stroke-width="4"></circle>
                <path class="opacity-75" fill="white" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>

        <main wire:loading.remove>
            @if ($selectedTab === 1)
                <livewire:predictor.fixtures-list />
            @elseif ($selectedTab === 2)
                <livewire:predictor.predictions-list />
            @elseif ($selectedTab === 3)
                <livewire:predictor.leaderboard />
            @elseif ($selectedTab === 4)
                <div class="py-12 px-4 flex flex-col gap-6">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            <div class="max-w-xl">
                                <livewire:profile.update-profile-information-form />
                            </div>
                        </div>
                    </div>

                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            <livewire:profile.update-password-form />
                        </div>
                    </div>

                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            <livewire:profile.delete-user-form />
                        </div>
                    </div>
                </div>
            @elseif ($selectedTab === 5)
                <div class="px-4 pt-4 flex flex-col gap-6">
                    <div class="py-4 px-7 rounded-4xl bg-euro-dark text-euro-light">

                        <h1 class="text-2xl mb-4 font-bold">Rules</h1>
                        <h2 class="text-xl mb-2 font-bold">Predictions</h2>
                        <p class="mb-2">For all group stage predictions, you must have predicted all results by kick off of the first game (June 14th 2024, 2100 CET).</p>
                        <p class="mb-2">For the knockout round, predictions need only be in by kick off of the game in question.</p>

                        <h2 class="text-xl mt-6 mb-2 font-bold">Scoring</h2>
                        <p class="mb-2">The break down of points awarded is as follows:</p>

                        <ul class="list-disc ml-6">
                            <li>
                                <h3 class="font-bold">5 points</h3>
                                <p class="mb-2">For guessing the exact score and result of a match [ES]</p>
                            </li>
                            <li>
                                <h3 class="font-bold">3 points</h3>
                                <p class="mb-2">For guessing the exact goal difference and result of a match [GD]</p>
                            </li>
                            <li>
                                <h3 class="font-bold">2 points</h3>
                                <p class="mb-2">For guessing the correct winner of a match [W]</p>
                            </li>
                            <li>
                                <h3 class="font-bold">0 points</h3>
                                <p class="mb-2">For not getting any of the above outcomes [L]</p>
                            </li>
                        </ul>

                        <h2 class="text-xl mt-6 mb-2 font-bold">Knockout stages</h2>

                        <p class="mb-2">Predictions for knockout games need ony be made by kick off of the game in question.</p>
                        <p class="mb-2">The score you predict is the result at the end of the game, be it 90 minutes or 120 should it go to extra time. Should the game be a draw after extra time, the penalites are not included in your prediction.</p>

                    </div>
                </div>
            @endif
        </main>

    </main>

    <footer class="h-22">
        <div class="bg-euro-darkest">
            <nav class="flex flex-row max-w-5xl mx-auto px-4 justify-between">

                <x-bottom-nav-item :tab="1" :text="__('Matches')" :selectedTab="$selectedTab">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="h-8 w-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z"></path>
                    </svg>
                </x-bottom-nav-item>

                <x-bottom-nav-item :tab="2" :text="__('Predictions')" :selectedTab="$selectedTab">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="h-8 w-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0118 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3l1.5 1.5 3-3.75"></path>
                    </svg>
                </x-bottom-nav-item>

                <x-bottom-nav-item :tab="3" :text="__('Leaderboard')" :selectedTab="$selectedTab">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="h-8 w-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"></path>
                    </svg>
                </x-bottom-nav-item>

            </nav>
        </div>
    </footer>

    <script>
        // Remeber scroll position when navigating between match/prediction detail and list
        let div = document.getElementById('scrollable')

        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('morph.updated', (el, component) => {
                console.log(el.component.name, component)

                if (el.component.name === 'predictor.navigation-bottom-tabs') {
                    localStorage.setItem("scroll-position", 0);
                    div.scrollTop = 0
                }

                if (!['predictor.fixtures-list', 'predictor.predictions-list'].includes(el.component.name)) {
                    return
                }

                setTimeout(() => {
                    if (el.clientHeight !== 0 && localStorage.getItem("scroll-position") != null) {
                        div.scrollTop = parseInt(localStorage.getItem("scroll-position"));
                    }
                }, 250);
            })
        });

        div.onscroll = function (e) {
            if (div.scrollTop !== 0) {
                localStorage.setItem("scroll-position", div.scrollTop);
            }
        }
    </script>
</div>
